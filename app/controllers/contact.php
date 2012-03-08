<?php

$app->get('/contact/',function() use ($app){
    
    $data['contacts'] = ORM::for_table('contacts')->order_by_asc('id')->find_many();
    $data['error_msg'] = $app->getCookie('error');
    $data['success_msg'] = $app->getCookie('success');
    
    $app->render('base/header.php');
    $app->render('contact/index.php',$data);
    $app->render('base/footer.php');
});

$app->get('/contact/add',function() use ($app){
    $app->render('base/header.php');
    $app->render('contact/add.php');
    $app->render('base/footer.php');    
});

$app->post('/contact/add',function() use ($app){
    
    $data = ORM::for_table('contacts')->order_by_desc('id')->find_one();
    
    $contact = ORM::for_table('contacts')->create();
    
    $contact->id = $data ? $data->id + 1 : 1;
    $contact->name = $_POST['name'];
    $contact->phone = $_POST['phone'];
    $contact->email = $_POST['email'];
    
    if($contact->save()){
        $app->setCookie('success', 'Dados salvos com sucesso!','4 seconds');
    }
    else{        
        $app->setCookie('error', 'Não foi possível salvar os dados!','4 seconds');
    }

    $app->redirect('/contact');
});

$app->get('/contact/del/:id',function($id) use ($app){
    
    if(!is_numeric($id)){
        $app->setCookie('error', 'Não foi possível excluir o contato!','4 seconds');
        $app->redirect('/contact');
    }
    
    $contact = ORM::for_table('contacts')->find_one($id);
    
    if(!$contact || !$contact->delete()){
        $app->setCookie('error', 'Não foi possível excluir o contato!','4 seconds');
        $app->redirect('/contact');        
    }
    
    $app->setCookie('success', 'Contato excluído com sucesso!','4 seconds');
     
    $app->redirect('/contact');
});

$app->get('/contact/edit/:id',function($id) use ($app){
    
    if(!is_numeric($id)){
        $app->setCookie('error', 'Não foi possível editar o contato!','4 seconds');
        $app->redirect('/contact');
    }
    
    $contact = ORM::for_table('contacts')->find_one($id);
    
    if(!$contact){
        $app->setCookie('error', 'Não foi possível editar o contato!','4 seconds');
        $app->redirect('/contact');        
    }    
    
    $app->render('base/header.php');
    $app->render('contact/edit.php',array('contact' => $contact));
    $app->render('base/footer.php');      
});

$app->post('/contact/edit/:id',function($id) use ($app){
    
    if(!is_numeric($id)){
        $app->setCookie('error', 'Não foi possível editar o contato!','4 seconds');
        $app->redirect('/contact');
    }
    
    $contact = ORM::for_table('contacts')->find_one($id);
    
    if(!$contact){
        $app->setCookie('error', 'Não foi possível editar o contato!','4 seconds');
        $app->redirect('/contact');        
    }     
    
    $contact->name = $_POST['name'];
    $contact->phone = $_POST['phone'];
    $contact->email = $_POST['email'];
    
    if($contact->save()){
        $app->setCookie('success', 'Dados salvos com sucesso!','4 seconds');
    }
    else{        
        $app->setCookie('error', 'Não foi possível editar o contato!','4 seconds');
    }

    $app->redirect('/contact');
});