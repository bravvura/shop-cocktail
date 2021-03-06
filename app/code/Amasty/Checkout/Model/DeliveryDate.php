<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) 2020 Amasty (https://www.amasty.com)
 * @package Amasty_Checkout
 */


namespace Amasty\Checkout\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

/**
 * Class DeliveryDate
 */
class DeliveryDate
{
    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    public function __construct(
        ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * @return array
     */
    public function getDeliveryDays()
    {
        $days = $this->scopeConfig->getValue(
            'amasty_checkout/delivery_date/available_days',
            ScopeInterface::SCOPE_STORE
        );

        if (!$days) {
            return [];
        }

        $days = explode(',', $days);

        foreach ($days as &$day) {
            $day = (int)$day;
        }

        return $days;
    }

    /**
     * @return array
     */
    public function getDeliveryHours()
    {

        // $hoursSetting = trim($this->scopeConfig->getValue(
        //     'amasty_checkout/delivery_date/available_hours',
        //     ScopeInterface::SCOPE_STORE
        // ));

        // $intervals = preg_split('#\s*,\s*#', $hoursSetting, -1, PREG_SPLIT_NO_EMPTY);

        // $hours = $this->getHours($intervals);

        // if (!$hours) {
        //     $hours = range(0, 23);
        // } else {
        //     $hours = array_unique($hours);
        //     asort($hours);
        // }

        // $options = [[
        //                 'value' => '-1',
        //                 'label' => ' ',
        //             ]];

        // foreach ($hours as $hour) {
        //     $options [] = [
        //         'value' => $hour,
        //         'label' => $hour . ':00 - ' . (($hour) + 1) . ':00',
        //     ];
        // }

        // return $options;
        ///////////////////////////chitrasen
        
         $hoursSetting = trim($this->scopeConfig->getValue(
             'amasty_checkout/delivery_date/available_hours',
              ScopeInterface::SCOPE_STORE
         ));
         $hours = explode(",",$hoursSetting);
         //echo "Prakash"; print_r($hours);die;
         $currentTime = time();
          /*$intervals = preg_split('#\s*,\s*#', $hoursSetting, -1, PREG_SPLIT_NO_EMPTY);

          $hours = $this->getHours($intervals);

          if (!$hours) {
              $hours = range(0, 23);
         } else {
              $hours = array_unique($hours);
              asort($hours);
          }*/

          $options = [[
                          'value' => '',
                         'label' => ' ',
                      ]];

         foreach ($hours as $hour) {
              $options [] = [
                  'value' => $hour,
                  'label' => $hour,
              ];
          }

          return $options;
        
        /////////////////////////

        /*if(!isset($_COOKIE['DeliveryDate'])) {
            $day=date("l");
        }
        else
        {
            $DeliverDate=$_COOKIE['DeliveryDate'];
            $day= date("l", strtotime($DeliverDate));
            setcookie("DeliveryDate", "", time() - 3600);
        }

        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $resource = $objectManager->get('Magento\Framework\App\ResourceConnection');
        $connection = $resource->getConnection();
        $tableName = $resource->getTableName('picker_slots');
        $shopperTable = $resource->getTableName('user_logins');

        $field[]='slot';
        
        $sql = $connection->select()
            ->from($tableName,$field) // to select some particular fields
            ->where('day = ?', $day)
            ->join(
                ['sp'=>$shopperTable],
                "picker_slots.picker_id = sp.id AND sp.status =1 AND sp.available =1 AND sp.active =1"
            );
        // ->where('currency_to = ?', 'EUR'); // adding WHERE condition with AND


        $hours = $connection->fetchAll($sql);


        $options = [[
            'value' => '',
            'label' => ' ',
        ]];


//                foreach ($hours as $hour) {
//                              $slot= $hour['slot'];
//
//                    $options [] = [
//                        'value' => $slot,
//                      //  'label' => $hour . ':00 - ' . (($hour) + 1) . ':00',
//                        'label' => $slot,
//                    ];
//                    }
        $slot_hours = array_unique(array_column($hours, 'slot'));
        usort($slot_hours,array($this,'my_sort'));


        foreach ($slot_hours as $hour) {

            $options [] = [
                'value' => $hour,
                'label' => $hour,
            ];

        }



        return $options;*/
    }

    /**
     * @param array $hours
     * @param array $range
     *
     * @return array
     */
    private function mergeHours($hours, $range)
    {
        return array_merge($hours, $range);
    }

    /**
     * @param array $intervals
     *
     * @return array
     */
    private function getHours($intervals)
    {
        $hours = [];

        foreach ($intervals as $interval) {
            if (preg_match('#(?P<lower>\d+)(\s*-\s*(?P<upper>\d+))?#', $interval, $matches)) {
                $lower = (int)$matches['lower'];
                if ($lower > 23) {
                    continue;
                }

                if (isset($matches['upper'])) {
                    $upper = (int)$matches['upper'];
                    if ($upper > 24) {
                        continue;
                    }

                    $upper--;

                    if ($lower > $upper) {
                        continue;
                    }
                } else {
                    $upper = $lower;
                }

                $range = range($lower, $upper);
                $hours = $this->mergeHours($hours, $range);
            }
        }

        return $hours;
    }
    public  function my_sort($a,$b)
    {
        $a=strtotime(trim(explode("-",$a)[0]));
        $b=strtotime(trim(explode("-",$b)[0]));
        if ($a==$b) return 0;
        return ($a<$b)?-1:1;
    }

}
