<?php declare(strict_types=1);
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

namespace System\Http;

// Использовать

/**
 * Класс Request
 */
class Request
{
    protected $request;

     public function __construct()
     {

     }

     public function __get($method)//: array
     {
         $methods = $this->getMethods();
         //$method = strtoupper($method);

         if (array_key_exists($method, $methods)) {
             return $methods[$method];

         } //else
             //throw new RequestException("Undefined method {$method}");
     }

     public function has(array $data, string $key)//, $output = null)
     {
         //if (is_array($data) && isset($data[$key])) {
         if (isset($data[$key])) {
             return $data[$key];
             return true;
         }

         return false;
     }

     protected function getMethods(): array
     {
         return [
             'get' => $_GET,
             'post' => $_POST,
             'files' => $_FILES
         ];
     }

 }
