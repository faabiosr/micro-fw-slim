                    <div class="row">
                        <div class="span2 pull-right"><a class="btn btn-success pull-right" href="add"><i class="icon-plus icon-white"></i> Adicionar</a></div>
                    </div>
                    <?php if(isset($error_msg) && $error_msg): ?>
                    <div class="alert alert-danger" style="margin-top: 10px;">
                        <strong><?php echo $error_msg; ?></strong>.
                    </div>                    
                    <?php endif; ?>
                    <?php if(isset($success_msg) && $success_msg): ?>
                    <div class="alert alert-success" style="margin-top: 10px;">
                        <strong><?php echo $success_msg; ?></strong>.
                    </div>                    
                    <?php endif; ?>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="red">Id</th>
                                <th>Nome</th>
                                <th>Telefone</th>
                                <th>E-mail</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(isset($contacts) && $contacts): ?>
                            <?php foreach($contacts as $c): ?>
                            <tr>
                                <td><?php echo $c->id; ?></td>
                                <td><?php echo $c->name; ?></td>
                                <td><?php echo $c->phone; ?></td>
                                <td><?php echo $c->email; ?></td>
                                <td>
                                    <a class="btn btn-info btn-mini" href="edit/<?php echo $c->id; ?>"><i class="icon-edit icon-white"></i> Editar</a> <a class="btn btn-danger btn-mini" href="del/<?php echo $c->id; ?>"><i class="icon-trash icon-white"></i> Excluir</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php else: ?>
                            <tr>
                                <td colspan="5">Contatos não encontrados</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>