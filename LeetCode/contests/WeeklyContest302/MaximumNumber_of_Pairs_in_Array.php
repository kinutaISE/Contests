<?php
class Solution {
  /**
   * @param Integer[] $nums
   * @return Integer[]
   */
  function numberOfPairs($nums) {
    $pair_num = 0 ;
    $residual_num = count($nums) ;
    // sort array
    sort($nums) ;

    for ($i = 0 ; $i < count($nums) - 1 ; $i++) {
      if ( $nums[$i] !== $nums[$i + 1] )
        continue ;
      $pair_num++ ;
      $residual_num -= 2 ;
      $i++ ;
    }

    return array($pair_num, $residual_num) ;
  }
}
