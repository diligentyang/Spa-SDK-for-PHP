<?php 

namespace Spa\Object\Interfaces\TargetingCustomizedAudience;



/**
 * Class Authorize
 *
 * @category PHP
 * @package  Spa
 * @author   Arno <arnoliu@tencent.com>
 */
class Authorize {

    /**
     * Instance of Spa.
     */
    protected $spa;

    /**
     * HTTP method.
     */
    protected $method;

    /**
     * The request endpoint.
     */
    protected $endpoint;

    protected $name;

    protected $title;


    /**
     * Init .
     */
    public function __construct($spa, $mod, $act) {

        $this->spa = $spa;

        $this->method = 'POST';

        $this->endpoint = $mod . '/' . $act;

    }

    public function send($params = array(), $headers = array()) {

        $this->validateField($params);

        $response = $this->spa->sendRequest($this->method, $this->endpoint, $params, $headers);

        return $response;
    }

    protected function validateField($params) {
        if (empty($params)) {
            return;
        }

        $data = $this->fieldInfo();

        // validate the required field
        $this->validateRequireField($data, $params);

        foreach ($params as $key => $value) {
            if (!isset($data[$key])) {
                continue;
            }

            $type = $data[$key]['type'];
            switch ($type) {
                case 'string':
                    
                    break;

                case 'integer':
                    
                    break;

                case 'id':

                case 'number':
                    
                    break;

                case 'struct':
                    
                    break;

                case 'array':
                    
                    break;

                default: break;
            }
        }
    }

    protected function validateRequireField($data, $params) {
        foreach ($data as $key => $value) {
            if ($value['require'] === 'no') {
                continue;
            }

            if (!isset($params[$key])) {
                throw new Exception("Expect the required params '$key' that you didn't provide");
                
            }
        }
    }

    public function fieldInfo() {
        return array(

            'advertiser_id' => array(
                'name' => 'advertiser_id',
                'extendType' => 'advertiser_id',
                'require' => 'yes',
                'type' => 'integer',
                'description' => '广告主ID',
                'restraint' => '详见附录',
                'errormsg' => '广告主ID不正确',
                'max' => '4294967296',
                'min' => '0',
            ),

            'audience_id' => array(
                'name' => 'audience_id',
                'extendType' => 'audience_id',
                'require' => 'yes',
                'type' => 'integer',
                'description' => '规则id',
                'restraint' => '规则id',
                'errormsg' => '规则id不正确',
            ),

            'authorized_advertiser_id' => array(
                'name' => 'authorized_advertiser_id',
                'extendType' => 'authorized_advertiser_id',
                'require' => 'yes',
                'type' => 'integer',
                'description' => '授权的广告主Id（子客户）',
                'restraint' => '授权的广告主Id（子客户）',
                'errormsg' => '授权的广告主Id（子客户）不正确',
                'max' => '4294967296',
                'min' => '0',
            ),

            'operation_type' => array(
                'name' => 'operation_type',
                'extendType' => 'operation_type',
                'require' => 'yes',
                'type' => 'string',
                'description' => '操作类型',
                'restraint' => '详见 [link href="operation_type"]操作类型[/link]',
                'errormsg' => '操作类型不正确',
                'enum' => 'enum',
                'source' => 'api_operation_type',
            ),

            'description' => array(
                'name' => 'description',
                'extendType' => 'authorized_description',
                'require' => 'no',
                'type' => 'string',
                'description' => '授权描述',
                'errormsg' => '授权描述不正确',
                'max_length' => '250',
                'min_length' => '0',
            ),

        );
    }

}

//end of script
