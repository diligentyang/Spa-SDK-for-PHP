<?php 

namespace Spa\Object\Interfaces\Agency;

use Spa\Object\Detector\FieldsDetector;

/**
 * Class GetAllTransactionDetail
 *
 * @category PHP
 * @package  Spa
 * @author   Arno <arnoliu@tencent.com>
 */
class GetAllTransactionDetail
{
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

    /**
     * Init .
     */
    public function __construct($spa, $mod, $act)
    {

        $this->spa = $spa;

        $this->method = 'GET';

        $this->endpoint = $mod . '/' . $act;

    }

    /**
     * Send a request.
     *
     * @param array $params  The request params.
     * @param array $headers The request headers.
     * @return Response
     */
    public function send($params = array(), $headers = array())
    {

        $data = $this->fieldInfo();

        FieldsDetector::validateField($params, $data);

        $response = $this->spa->sendRequest($this->method, $this->endpoint, $params, $headers);

        return $response;
    }

    /**
     * The fields info.
     */
    public function fieldInfo()
    {
        return array(

            'account_type' => array(
                'name' => 'account_type',
                'extendType' => 'account_type',
                'require' => 'yes',
                'type' => 'string',
                'description' => '账户类型',
                'restraint' => '见 [link href="account_type_map"]账户类型定义[/link]',
                'errormsg' => '账户类型不正确',
                'enum' => 'enum',
                'source' => 'api_account_type_map',
            ),

            'date_range' => array(
                'name' => 'date_range',
                'extendType' => 'date_range',
                'require' => 'yes',
                'type' => 'struct',
                'description' => '时间范围',
                'restraint' => '日期格式，{"start_date":"2014-03-01","end_date":"2014-04-02"}',
                'errormsg' => '时间范围不正确',
                'element' => array(
                    'start_date' => array(
                        'name' => 'start_date',
                        'extendType' => 'start_date',
                        'require' => 'yes',
                        'type' => 'string',
                        'description' => '开始投放时间点对应的时间戳',
                        'restraint' => '大于等于0，且小于end_time',
                        'errormsg' => '开始投放时间不正确',
                        'max_length' => '10',
                        'min_length' => '10',
                        'pattern' => '{date_pattern}',
                    ),

                    'end_date' => array(
                        'name' => 'end_date',
                        'extendType' => 'end_date',
                        'require' => 'yes',
                        'type' => 'string',
                        'description' => '结束投放时间点对应的时间戳点对应的时间戳',
                        'restraint' => '大于等于今天，且大于begin_time',
                        'errormsg' => '结束投放时间点对应的时间戳不正确',
                        'max_length' => '10',
                        'min_length' => '10',
                        'pattern' => '{date_pattern}',
                    ),

                ),
            ),

            'page' => array(
                'name' => 'page',
                'extendType' => 'page',
                'require' => 'no',
                'type' => 'integer',
                'description' => '搜索页码',
                'restraint' => '大于等于1，若不传则视为1',
                'errormsg' => '页码不正确',
                'max' => '99999',
                'min' => '1',
            ),

            'page_size' => array(
                'name' => 'page_size',
                'extendType' => 'page_size',
                'require' => 'no',
                'type' => 'integer',
                'description' => '一页显示的数据条数',
                'restraint' => '大于等于1，且小于100，若不传则视为10',
                'errormsg' => '每页显示条数不正确',
                'max' => '100',
                'min' => '1',
            ),

            'no_page' => array(
                'name' => 'no_page',
                'extendType' => 'no_page',
                'require' => 'no',
                'type' => 'integer',
                'description' => '不分页',
                'restraint' => '传递这个参数，则忽略分页参数，获取时间范围内的全部记录',
                'errormsg' => '参数（no_page）不正确',
                'max' => '1',
                'min' => '0',
            ),

        );
    }

}

//end of script
