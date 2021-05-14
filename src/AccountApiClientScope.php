<?php
/**
 * Created by PhpStorm.
 * User: marcelozani
 * Date: 14/07/16
 * Time: 17:47
 */

namespace Reciclare\AccountClientSDK;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\Config;
use Illuminate\Session;
use Carbon\Carbon;
use Mockery\CountValidator\Exception;

class AccountApiClientScope
{
    public static function serverApiUrlScopeGetall()
    {
        return AccountApiConfig::$api_url.'/scopes/getall';
    }
    public static function serverApiUrlScopeGet()
    {
        return AccountApiConfig::$api_url.'/scopes/get';
    }
    public static function serverApiUrlScopeRegister()
    {
        return AccountApiConfig::$api_url.'/scopes/create';
    }
    public static function serverApiUrlScopeUpdate()
    {
        return AccountApiConfig::$api_url.'/scopes/update';
    }
    public static function serverApiUrlScopeActivate()
    {
        return AccountApiConfig::$api_url.'/scopes/activate';
    }
    public static function serverApiUrlScopeDeactivate()
    {
        return AccountApiConfig::$api_url.'/scopes/deactivate';
    }
    public static function serverApiUrlScopeAddGroup()
    {
        return AccountApiConfig::$api_url.'/scopes/addgroup';
    }

    public static function getAllScopes($token, $page = null)
    {
        try {
            $client = new Client();
            $res = $client->request('POST', AccountApiClientScope::serverApiUrlScopeGetall(), [
                'form_params' =>
                    [
                        'access_token' => $token,
                        'page' => $page
                    ]
            ]);
            $allScopes_response = json_decode($res->getBody());
            return $allScopes_response;
        } catch (ClientException $e) {
            $error_messages = null;
            if ($e->getCode() == 401){
                $error_messages = json_decode($e->getResponse()->getBody());
            }

            throw new AccountApiClientException('Erro pegando todos os grupos', $error_messages);
        }
    }

    public static function getScope($token, $id)
    {
        try {
            $client = new Client();
            $res = $client->request('POST', AccountApiClientScope::serverApiUrlScopeGet().'/'.$id, [
                'form_params' =>
                    [
                        'access_token' => $token
                    ]
            ]);
            $getApp_response = json_decode($res->getBody());
            return $getApp_response;
        } catch (ClientException $e) {
            $error_messages = null;
            if ($e->getCode() == 401){
                $error_messages = json_decode($e->getResponse()->getBody());
            }

            throw new AccountApiClientException('Erro recuperando dados do grupo.', $error_messages);
        }
    }

    public static function registerScope($token, $grant_id, $scope)
    {
        try {
            $client = new Client();
            $res = $client->request('POST', AccountApiClientScope::serverApiUrlScopeRegister().'/'.$grant_id , [
                'form_params' =>
                    [
                        'access_token' => $token,
                        'description' => $scope['description'],
                        'short_code' => $scope['short_code'],
                        'filter' => $scope['filter']
                    ]
            ]);
            $registerScope_response = json_decode($res->getBody());
            return $registerScope_response;
        } catch (ClientException $e) {
            $error_messages = null;
            if ($e->getCode() == 401){
                $error_messages = json_decode($e->getResponse()->getBody());
            }

            throw new AccountApiClientException('Erro tentando criar um Grupo.', $error_messages);
        }
    }

    public static function updateScope($token, $grant_id, $scope_id, $scope)
    {
        try {
            $client = new Client();
            $res = $client->request('POST', AccountApiClientScope::serverApiUrlScopeUpdate().'/'.$grant_id.'/'.$scope_id, [
                'form_params' =>
                    [
                        'access_token' => $token,
                        'description' => $scope['description'],
                        'short_code' => $scope['short_code'],
                        'filter' => $scope['filter']
                    ]
            ]);
            $updateApp_response = json_decode($res->getBody());
            return $updateApp_response;
        } catch (ClientException $e) {
            $error_messages = null;
            if ($e->getCode() == 401){
                $error_messages = json_decode($e->getResponse()->getBody());
            }

            throw new AccountApiClientException('Erro atualizando um aplicativo.', $error_messages);
        }
    }

    public static function activateScope($token, $id)
    {
        try {
            $client = new Client();
            $res = $client->request('POST', AccountApiClientScope::serverApiUrlScopeActivate().'/'.$id, [
                'form_params' =>
                    [
                        'access_token' => $token
                    ]
            ]);
            $activateScope_response = json_decode($res->getBody());
            return $activateScope_response;
        } catch (ClientException $e) {
            $error_messages = null;
            if ($e->getCode() == 401){
                $error_messages = json_decode($e->getResponse()->getBody());
            }

            throw new AccountApiClientException('Erro ativando aplicativo.', $error_messages);
        }
    }

    public static function deactivateScope($token, $id)
    {
        try {
            $client = new Client();
            $res = $client->request('POST', AccountApiClientScope::serverApiUrlScopeDeactivate().'/'.$id, [
                'form_params' =>
                    [
                        'access_token' => $token
                    ]
            ]);
            $deactivateScope_response = json_decode($res->getBody());
            return $deactivateScope_response;
        } catch (ClientException $e) {
            $error_messages = null;
            if ($e->getCode() == 401){
                $error_messages = json_decode($e->getResponse()->getBody());
            }

            throw new AccountApiClientException('Erro desativando aplicativo.', $error_messages);
        }
    }
}