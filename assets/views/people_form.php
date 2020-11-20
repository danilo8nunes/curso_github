<div class="container px-2 py-0 mb-3 mx-auto">
    <a class="link-ask text-decoration-none bg-danger ml-2" href="<?= url();?>people/">
        <i class="fas fa-home float-left" style="font-size:40px"></i>
        <span class="link-answer float-left ml-2 align-items-center" style="display:none;height:40px;">
            Página Inicial
        </span>
    </a>
<div class="container mx-auto my-3 p-3">
    <h2><?= $subtitle; ?></h2>
    <form action="<?= $action; ?>" method="post" enctype="multipart/form-data">
        <div class="form-group <?= $class; ?>">
            <label for="id">Código:</label>
            <input type="text" class="form-control" readonly="1" value="<?= !empty($people->id) ? $people->id : '' ?>" placeholder="id" name="id">
        </div>
        <div class="form-group">
            <label for="first_name">Nome:</label>
            <input type="text" class="form-control" value="<?= !empty($people->first_name) ? $people->first_name : '' ?>" placeholder="Diga o nome" name="first_name" required>
        </div>
        <div class="form-group">
            <label for="last_name">Sobrenome:</label>
            <input type="text" class="form-control" value="<?= !empty($people->last_name) ? $people->last_name : '' ?>" placeholder="Diga o sobrenome" name="last_name" required>
        </div>
        <div class="form-group">
            <label for="phone_number">Telefone:</label>
            <input type="text" class="form-control" value="<?= !empty($people->phone_number) ? $people->phone_number : '' ?>" placeholder="Diga o telefone" name="phone_number" required>
        </div>
        <div class="form-group">
            <label for="email">E-mail:</label>
            <input type="email" class="form-control" value="<?= !empty($people->email) ? $people->email : '' ?>" placeholder="Diga o e-mail" name="email" required>
        </div>
        <button type="submit" class="btn-block btn-primary p-1"><?= $button; ?></button>
    </form>
</div>