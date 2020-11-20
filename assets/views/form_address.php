<div class="container mx-auto my-1 p-2">
    <h2><?= $subtitle; ?></h2>
    <form action="<?= $action; ?>" method="post" enctype="multipart/form-data" id="formAddress">
        <div class="form-group <?= $class; ?>">
            <label for="id">Código:</label>
            <input type="text" class="form-control" readonly="1" value="<?=$address->id ?? ""?>" name="id">
        </div>
        <div class="form-group <?= $class; ?>">
            <label for="id">Código Contato:</label>
            <input type="text" class="form-control" readonly="1" value="<?=$address->id_people ?? $idPeople?>" name="id_people">
        </div>
        <div class="form-group">
            <label for="cep">CEP:</label>
            <input type="text" class="form-control" required value="<?=$address->cep ?? ""?>" placeholder="Digite seu CEP" name="cep">
            <p class='text-danger mx-3 mt-2 cep-erro'></p>
        </div>
        <div class="form-group">
            <label for="public_place">Logradouro:</label>
            <input type="text" class="form-control" required value="<?=$address->public_place ?? ""?>" name="public_place">
        </div>
        <div class="form-group">
            <label for="complement">Complemento:</label>
            <input type="text" class="form-control" value="<?=$address->complement ?? ""?>" name="complement">
        </div>
        <div class="form-group">
            <label for="neighborhood">Bairro:</label>
            <input type="text" class="form-control" required value="<?=$address->neighborhood ?? ""?>" name="neighborhood">
        </div>
        <div class="form-group">
            <label for="city">Cidade:</label>
            <input type="text" class="form-control" required readonly="1" value="<?=$address->city ?? ""?>" name="city">
        </div>
        <div class="form-group">
            <label for="uf">Estado:</label>
            <input type="text" class="form-control" required readonly="1" value="<?=$address->uf ?? ""?>" name="uf">
        </div>
    
        <button type="submit" class="btn-block btn-primary p-1"><strong><?= $button; ?></strong></button>
    </form>
</div>