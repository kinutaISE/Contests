<?php
class Solution {
  /**
   * @param Integer[] $nums
   * @return Integer
   */
  function maximumSum($nums) {
    $digit_sums = array() ;
    foreach ($nums as $num)
      $digit_sums[] = $this->digitSum($num) ;

    array_multisort(
      $digit_sums, SORT_ASC, SORT_NUMERIC,
      $nums, SORT_DESC, SORT_NUMERIC
    ) ;
    $groups = array() ;
    $groups[] = array() ;
    $group_num = 1 ;
    $current = $digit_sums[0] ;
    foreach ($digit_sums as $key => $digit_sum) {
      if ($current != $digit_sum) {
        $groups[] = array() ;
        $group_num++ ;
        $current = $digit_sum ;
      }
      $groups[$group_num - 1][] = $key ;
    }

    $max_sums = array() ;
    foreach ($groups as $group)
      $max_sums[] = $this->calcMaxSum($group, $nums) ;

    return max( $max_sums ) ;
  }
  function digitSum($num) {
    $sum = 0 ;
    while ($num > 0) {
      $sum += $num % 10 ;
      $num /= 10 ;
      $num = floor($num) ;
    }
    return $sum ;
  }
  function calcMaxSum($group, $nums) {
    return ( count($group) < 2 ? -1 : $nums[ $group[0] ] + $nums[ $group[1] ] ) ;
  }
}
