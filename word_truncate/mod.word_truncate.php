<?php
class Modifier_word_truncate extends Modifier
{
    public function index($value, $parameters=array())
    {
      if(isset($parameters[1]) && $parameters[1] != "") $ending = $parameters[1];
      else $ending = "&hellip;";
      $length = $parameters[0];
      
      
      $words = preg_split("/[\n\r\t ]+/", $value, $length + 1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_OFFSET_CAPTURE);
      if (count($words) > $length) {
          end($words);
          $last_word = prev($words);

          $output = substr($value, 0, $last_word[1] + strlen($last_word[0])) . $ending;
      }
      
      #put all opened tags into an array
      preg_match_all ( "#<([a-z]+)( .*)?(?!/)>#iU", $output, $result );
      $openedtags = $result[1];
      #put all closed tags into an array
      preg_match_all ( "#</([a-z]+)>#iU", $output, $result );
      $closedtags = $result[1];
      $len_opened = count ( $openedtags );
      # all tags are closed
      if( count ( $closedtags ) == $len_opened )
      {
      return $output;
      }
      $openedtags = array_reverse ( $openedtags );
      # close tags
      for( $i = 0; $i < $len_opened; $i++ )
      {
          if ( !in_array ( $openedtags[$i], $closedtags ) )
          {
          $output .= "</" . $openedtags[$i] . ">";
          }
          else
          {
          unset ( $closedtags[array_search ( $openedtags[$i], $closedtags)] );
          }
      }

      return $output;
      
    }
}

?>