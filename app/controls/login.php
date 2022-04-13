<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json');
require_once ('../../config/autoload.php');
require_once ('../../config/config.php');
require_once ('../../config/public_functions.php');
require_once ('adminFunctions.php');


use app\controls\authUser;
use app\controls\session;
use app\controls\reportBug;
use app\controls\activityRecord;

$server_failure = array(
    'status'  => 'error',
    'message' => 'El servidor no responde.',
    'link'    => '',
);
    
if(empty($_POST['login']) or !isset($_POST['login']) or empty($_POST['password']) or !isset($_POST['password']))
{
    $response = array(
        'status'  => 'error',
        'message' => 'Rellena todos los campos.',
        'link'    => '',
      );
    die(json_encode($response));
}
else{
    $user = filterString($_POST['login'], 'CHAR');
    $password = filterString($_POST['password'], 'CHAR');
    
    $auth = new authUser();
    $auth->startAuth($user, $password);
    
    /* Verifica se o usuário existe */
    if($auth->existUser() === true ){
        /* Verifica se a conta está ativa */
        if($auth->isActive() === false){
            $response = array(
                'status'  => 'error',
                'message' => 'Cuenta desactivada',
                'link'    => '',
            );
            die(json_encode($response));
        }
        else{
            /* Verifica se a senha é a mesma do banco  */
            if($auth->checkPassword() === true and $auth->isExceededAttempts() === false){
                if($auth->startSession() === true){
                    $auth->resetAttempts();
                    $register_activity = new activityRecord();
                    $register_activity->record ($auth->user_id, 'private', 'login', 'ingrese al sistema', null);
                    
                    $response = array(
                        'status'  => 'success',
                        'message' => 'Usuario conectado con éxito',
                        'link'    => '',
                    );
                    die(json_encode($response));
                }
                else{
                    $response = array(
                        'status'  => 'error',
                        'message' => 'No se puede iniciar la sesión.',// trocar mensagem após testes
                        'link'    => '',
                    );
                    die(json_encode($response));
                }
            }
            else if($auth->checkPassword() === true and $auth->isExceededAttempts() !== false){
                $response = array(
                    'status'  => 'error',
                    'message' => 'Inténtelo despues de '.$auth->isExceededAttempts().' minutos.',
                    'link'    => '',
                );
                die(json_encode($response));
            }
            else if($auth->checkPassword() === false and $auth->isExceededAttempts() !== false){
                $auth->registerAttempts();
                $response = array(
                    'status'  => 'error',
                    'message' => 'Inténtelo despues de '.$auth->isExceededAttempts().' minutos.',
                    'link'    => '',
                );
                die(json_encode($response));
            }
            else if($auth->checkPassword() === false and $auth->isExceededAttempts() === false){
                $auth->registerAttempts();
                $response = array(
                    'status'  => 'error',
                    'message' => 'Contraseña incorrecta',
                    'link'    => '',
                );
                die(json_encode($response));
            }
            else{   
                $auth->registerAttempts();
                $response = array(
                    'status'  => 'error',
                    'message' => 'Não entendemos seu pedido',
                    'link'    => '',
                );
                die(json_encode($response));
            }// if se a senha confere
        }// if se a conta está ativa
    }
    else{
         $response = array(
             'status'  => 'info',
             'message' => 'Usuario no registrado',
             'link'    => '',
          );
          die(json_encode($response));
    }
    // if se existe usuário --end--
}