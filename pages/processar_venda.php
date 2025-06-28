<?php
include 'conexao.php';

$selecionados = $_POST['selecionados'] ?? [];
$quantidades = $_POST['quantidade'] ?? [];

if (empty($selecionados)) {
    die('Nenhum produto selecionado para a venda.');
}

$conn->begin_transaction();

try {
    $usuario_id = 1; // Troque para o usuário logado se tiver sistema

    // Calcula total da venda
    $total_venda = 0;
    foreach ($selecionados as $produto_id) {
        $qtd = isset($quantidades[$produto_id]) ? intval($quantidades[$produto_id]) : 0;
        if ($qtd <= 0) continue;

        $sql = "SELECT valor_venda, quantidade_inicial FROM produtos WHERE id = $produto_id LIMIT 1";
        $res = $conn->query($sql);
        if (!$res || $res->num_rows == 0) {
            throw new Exception("Produto ID $produto_id não encontrado.");
        }
        $row = $res->fetch_assoc();

        if ($row['quantidade_inicial'] < $qtd) {
            throw new Exception("Estoque insuficiente para o produto '{$row['nome']}' (ID $produto_id).");
        }

        $total_venda += $row['valor_venda'] * $qtd;
    }

    // Inserir venda
    $stmt = $conn->prepare("INSERT INTO vendas (data_venda, usuario_id) VALUES (CURDATE(), ?)");
    $stmt->bind_param("i", $usuario_id);
    $stmt->execute();

    $venda_id = $stmt->insert_id;
    $stmt->close();

    // Inserir itens e atualizar estoque
    $stmt_item = $conn->prepare("INSERT INTO itens_venda (venda_id, produto_id, quantidade, valor_unitario) VALUES (?, ?, ?, ?)");
    $stmt_update = $conn->prepare("UPDATE produtos SET quantidade_inicial = quantidade_inicial - ? WHERE id = ?");

    foreach ($selecionados as $produto_id) {
        $qtd = isset($quantidades[$produto_id]) ? intval($quantidades[$produto_id]) : 0;
        if ($qtd <= 0) continue;

        $sql = "SELECT valor_venda FROM produtos WHERE id = $produto_id LIMIT 1";
        $res = $conn->query($sql);
        $row = $res->fetch_assoc();
        $valor_unitario = $row['valor_venda'];

        // Inserir item
        $stmt_item->bind_param("iiid", $venda_id, $produto_id, $qtd, $valor_unitario);
        $stmt_item->execute();

        // Atualizar estoque
        $stmt_update->bind_param("ii", $qtd, $produto_id);
        $stmt_update->execute();
    }

    $stmt_item->close();
    $stmt_update->close();

    $conn->commit();

    header("Location: venda_sucesso.php?venda_id=$venda_id");
    exit;

} catch (Exception $e) {
    $conn->rollback();
    die("Erro ao processar venda: " . $e->getMessage());
}
