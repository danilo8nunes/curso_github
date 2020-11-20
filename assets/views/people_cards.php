<div class="container px-2 py-0 mb-3 mx-auto">
    <a class="link-ask text-decoration-none bg-danger ml-2" href="<?= url();?>people/form">
        <i class="fas fa-plus-circle float-left" style="font-size:40px"></i>
        <span class="link-answer float-left ml-2 align-items-center" style="display:none;height:40px;">
            Adicionar Contato
        </span>
    </a>
</div>
<div class="container px-2 mx-auto d-flex flex-wrap justify-content-center">
    <?php if (!empty($result)) : ?>
        <?php foreach ($result as $people):?>
            <div class="box-contact mx-2 my-2 rounded align-self-start border-left">
                <div class="p-1 d-flex flex-wrap" style="width:320px;">
                    <div class="p-1" style="width:61px;">
                        <i class="text-light fas fa-user" style="font-size:60px;"></i>
                    </div>
                    <div class="p-1" style="width:251px;">
                        <p class="p-0 m-0">
                            <i class="text-muted fas fa-user mr-1"></i>
                            <?=$people->first_name;?> <?=$people->last_name;?>
                        </p>
                        <p class="p-0 m-0">
                            <i class="text-muted fas fa-phone mr-1"></i>
                            <?=$people->phone_number;?>
                        </p>
                        <p class="p-0 m-0 text-truncate">
                            <i class="text-muted fas fa-at mr-1"></i>
                            <?=$people->email;?>
                        </p>
                    </div>
                </div>
                <div class="box-address p-3" style="display:none;">
                    <p class="p-0 m-0"><strong>Endereço:</strong></p>
                    <p class="p-0 m-0">Rua da Esquina, 369</p>
                    <p class="p-0 m-0">Rio de Janeiro, RJ - 21000-000</p>
                    <div class="d-flex justify-content-end">
                        <a href="<?=url();?>people/form/&id=<?= $people->id;?>" title="Editar usuário"
                            class="mx-1">
                            <i class="icon-hover text-muted fas fa-edit"></i>
                        </a>
                        <a href="#" title="Editar endereço" class="mx-1">
                            <i class="icon-hover text-muted fas fa-city"></i>
                        </a>
                    </div>
                </div> 
            </div>
    <?php endforeach; ?>
                <?php else :?>
                    <h1 class="display-3">Nenhum Usuário cadastrado</h1>
                <?php endif; ?>
</div>













<!-- <div class='container p-1 mx-auto'>
    <div class='table-responsive'>
        <table class='table table-sm table-striped table-hover text-center'>
            <thead class='thead-light'>
                <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th>Sobrenome</th>
                    <th>Telefone</th>
                    <th>Endereço</th>
                    <th>Email</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($result)) : ?>
                    <?php foreach ($result as $people):?>
                        <tr>
                            <td><?= $people->id; ?></td>
                            <td><?= $people->first_name; ?></td>
                            <td><?= $people->last_name; ?></td>
                            <td><?= $people->phone_number; ?></td>
                            <td>
                                <a class="text-decoration-none text-dark" title="Editar Endereço" href="<?=url();?>address/form/&id=<?=$people->id;?>">
                                    <i class="fas fa-edit"></i>
                                </a>  |  
                                <a class="text-decoration-none text-dark m-view" title="Ver Endereço" href="#" data-action="<?=url();?>address/view/&id=<?=$people->id;?>">
                                    <i class="fas fa-list"></i>
                                </a>
                            </td>
                            <td><?= $people->email; ?></td>
                            <td>
                                <a class="text-decoration-none text-dark" title="Editar Contato" href="<?=url();?>people/form/&id=<?= $people->id;?>">
                                    <i class="fas fa-edit"></i>
                                </a>  |  
                                <a class="text-decoration-none text-dark m-delete" title="Excluir Contato" href="#" data-action="<?= url();?>people/drop/&id=<?=$people->id;?>">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                    <?php endforeach; ?>
                <?php else :?>
                        <tr>
                            <td colspan='7' class='text-center'>Nenhuma Pessoa encontrada</td>
                <?php endif; ?>
                        </tr>
            </tbody>
        </table>
    </div>
</div>

<?php //require __DIR__ . "/modal_address.php"?>
<?php //require __DIR__ . "/modal_delete.php"?> -->
