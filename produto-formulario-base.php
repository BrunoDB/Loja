<tr>
    <td>Nome</td>
    <td><input class="form-control" type="text" name="nome" value="<?=$produto->getNome() ?>"/></td>
</tr>

<tr>
    <td>Preço</td>
    <td><input class="form-control" type="number" name="preco" value="<?=$produto->getPreco() ?>"/></td>
</tr>

<tr>
    <td>Descrição</td>
    <td><textarea name="descricao" class="form-control"><?=$produto->getDescricao() ?></textarea>
</tr>

<tr>
    <td></td>
    <td><input type="checkbox" name="usado" value="true" <?=$usado?>> Usado
</tr>

<tr>

    <td>Categoria</td>
    <td>
        <select name="categoria_id">
        <?php foreach($categorias as $categoria) : 
         $essaEhACategoria = $produto->getCategoria()->getId() == $categoria->getId();
		 
         $selecao = $essaEhACategoria ? "selected='selected'" : "";
        ?>
        <option value="<?=$categoria->getId() ?>" <?=$selecao?>><?=$categoria->getNome() ?></option>
        <?php endforeach ?>
        </select>
    </td>
</tr>
<tr>
    <td>Tipo de produto</td>
    <td>
        <select name="tipoProduto">
            <optgroup label="Livro">
                <option value="Ebook">Ebook</option>
                <option value="LivroFisico">Livro Físico</option>
            </optgroup>
        </select>
    </td>
<tr>
<tr>
    <td>ISBN (quando for um livro)</td>
    <td><input name="isbn" value="<?php if ($produto->temIsbn()) { echo $produto->getIsbn(); } ?>"/></td>
<tr>