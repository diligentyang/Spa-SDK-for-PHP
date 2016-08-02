<?php 

namespace Spa\Object\Interfaces\Adgroup;

use Spa\Exceptions\ParamsException;
use Spa\Object\Detector\FieldsDetector;

/**
 * Class Create
 *
 * @category PHP
 * @package  Spa
 * @author   Arno <arnoliu@tencent.com>
 */
class Create {

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

        $data = $this->fieldInfo();

        FieldsDetector::validateField($params, $data);

        $response = $this->spa->sendRequest($this->method, $this->endpoint, $params, $headers);

        return $response;
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

            'campaign_id' => array(
                'name' => 'campaign_id',
                'extendType' => 'campaign_id',
                'require' => 'yes',
                'type' => 'id',
                'description' => '推广计划Id',
                'restraint' => '小于2^63',
                'errormsg' => '推广计划Id不正确',
                'max' => '9223372036854775807',
                'min' => '1',
            ),

            'targeting_id' => array(
                'name' => 'targeting_id',
                'extendType' => 'targeting_id',
                'require' => 'yes',
                'type' => 'id',
                'description' => '定向Id',
                'restraint' => '小于2^63',
                'errormsg' => '定向Id不正确',
                'max' => '9223372036854775807',
                'min' => '1',
            ),

            'adgroup_name' => array(
                'name' => 'adgroup_name',
                'extendType' => 'adgroup_name',
                'require' => 'yes',
                'type' => '',
            ),

            'bid_type' => array(
                'name' => 'bid_type',
                'extendType' => 'bid_type',
                'require' => 'yes',
                'type' => '',
            ),

            'bid_amount' => array(
                'name' => 'bid_amount',
                'extendType' => 'bid_amount',
                'require' => 'yes',
                'type' => '',
            ),

            'begin_date' => array(
                'name' => 'begin_date',
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

            'site_set' => array(
                'name' => 'site_set',
                'extendType' => 'site_set',
                'require' => 'yes',
                'type' => '',
            ),

            'outer_adgroup_id' => array(
                'name' => 'outer_adgroup_id',
                'extendType' => 'outer_adgroup_id',
                'require' => 'no',
                'type' => '',
            ),

            'time_series' => array(
                'name' => 'time_series',
                'extendType' => 'time_series',
                'require' => 'no',
                'type' => '',
            ),

            'product_type' => array(
                'name' => 'product_type',
                'extendType' => 'product_type',
                'require' => 'yes',
                'type' => '',
            ),

            'product_refs_id' => array(
                'name' => 'product_refs_id',
                'extendType' => 'product_refs_id',
                'require' => 'no',
                'type' => 'string',
                'description' => '标的物Id',
                'restraint' => '小于128个英文字符',
                'errormsg' => '标的物Id不正确',
                'max_length' => '128',
                'min_length' => '0',
            ),

            'subordinate_product_refs_id' => array(
                'name' => 'subordinate_product_refs_id',
                'extendType' => 'subordinate_product_refs_id',
                'require' => 'no',
                'type' => '',
            ),

            'creative_selection_type' => array(
                'name' => 'creative_selection_type',
                'extendType' => 'creative_selection_type',
                'require' => 'no',
                'type' => '',
            ),

            'customized_category' => array(
                'name' => 'customized_category',
                'extendType' => 'customized_category',
                'require' => 'no',
                'type' => '',
            ),

            'min_impression_include' => array(
                'name' => 'min_impression_include',
                'extendType' => 'min_impression_include',
                'require' => 'no',
                'type' => '',
            ),

            'max_impression_include' => array(
                'name' => 'max_impression_include',
                'extendType' => 'max_impression_include',
                'require' => 'no',
                'type' => '',
            ),

            'click_tracking_url' => array(
                'name' => 'click_tracking_url',
                'extendType' => 'click_tracking_url',
                'require' => 'no',
                'type' => '',
            ),

            'creative_combination_type' => array(
                'name' => 'creative_combination_type',
                'extendType' => 'creative_combination_type',
                'require' => 'no',
                'type' => '',
            ),

            'dynamic_creative_recommend_type' => array(
                'name' => 'dynamic_creative_recommend_type',
                'extendType' => 'dynamic_creative_recommend_type',
                'require' => 'no',
                'type' => '',
            ),

            'configured_status' => array(
                'name' => 'configured_status',
                'extendType' => 'configured_status',
                'require' => 'no',
                'type' => 'string',
                'description' => '用户状态',
                'errormsg' => '用户状态不正确',
                'enum' => 'enum',
                'source' => 'api_configured_status',
            ),

            'total_budget' => array(
                'name' => 'total_budget',
                'extendType' => 'total_budget',
                'require' => 'no',
                'type' => 'integer',
                'description' => '总消耗限额，单位为分',
                'restraint' => '大于5000，且小于20000000000',
                'errormsg' => '总消耗限额不正确',
                'max' => '20000000000',
                'min' => '5000',
            ),

        );
    }

}

//end of script
