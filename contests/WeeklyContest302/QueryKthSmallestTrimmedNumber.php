<?php
class Solution {
  /**
   * @param String[] $nums
   * @param Integer[][] $queries
   * @return Integer[]
   */
  function smallestTrimmedNumbers($nums, $queries) {
    $answer = array() ;
    foreach ($queries as $query) {
      $trimed_nums = $this->getTrimedNums($nums, $query[1]) ;

      $indices = array_keys($nums) ;
      array_multisort(
        $trimed_nums, SORT_ASC, SORT_NUMERIC,
        $indices, SORT_ASC, SORT_NUMERIC
      ) ;

      echo var_dump($indices) . PHP_EOL ;
      echo var_dump($trimed_nums) . PHP_EOL ;

      $answer[] = $this->findKthIndex($indices, $trimed_nums, $query[0]) ;
    }
    return $answer ;
  }
  function getTrimedNums($nums, $trim) {
    $trimed_nums = array() ;
    foreach ($nums as $num)
      $trimed_nums[] = substr($num, strlen($num) - $trim, 1) ;
    return $trimed_nums ;
  }
  function findKthIndex($indices, $trimed_nums, $k) {
    return $indices[$k - 1] ;
  }
}
