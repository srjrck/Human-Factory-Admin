<?php
namespace App\Helpers;
use DateTime;
use Date;
use DB;
class Common {
	
	public static function AlertErrorMsg($ErrorType,$Msg) {
		if($ErrorType == 'Success'){
			$AlertErrorMsg = '<div class="alert alert-success alert-dismissible" role="alert">
				    							<button type="button" class="close" data-dismiss="alert">×</button>
				    							<div class="alert-icon"><i class="icon-check"></i></div>
				    							<div class="alert-message">
				      							<span>'.$Msg.'</span>
				    							</div>
                  			</div>';
		}elseif($ErrorType == 'Danger'){
			$AlertErrorMsg = '<div class="alert alert-danger alert-dismissible" role="alert">
				    							<button type="button" class="close" data-dismiss="alert">×</button>
				    							<div class="alert-icon"><i class="icon-close"></i></div>
				    							<div class="alert-message">
				      							<span>'.$Msg.'</span>
				    							</div>
                  			</div>';

		}elseif($ErrorType == 'Info'){
			$AlertErrorMsg = '<div class="alert alert-info alert-dismissible" role="alert">
				    							<button type="button" class="close" data-dismiss="alert">×</button>
				    							<div class="alert-icon"><i class="icon-info"></i></div>
				    							<div class="alert-message">
				      							<span>'.$Msg.'</span>
				    							</div>
                  			</div>';
		}elseif($ErrorType == 'Warning'){
			$AlertErrorMsg = '<div class="alert alert-warning alert-dismissible" role="alert">
				    							<button type="button" class="close" data-dismiss="alert">×</button>
				    							<div class="alert-icon"><i class="icon-exclamation"></i></div>
				    							<div class="alert-message">
				      							<span>'.$Msg.'</span>
				    							</div>
                  			</div>';
		}else{
			$AlertErrorMsg = '';
		}
		return $AlertErrorMsg;
	}

	public static function Pagination($numofrecords, $count, $page){
		$per_page = $numofrecords;
		$previous_btn = true;
		$next_btn = true;
		$first_btn = true;
		$last_btn = true;
		$start = $page * $per_page;
		$cur_page = $page;
		$msg = "";
		$no_of_paginations = ceil($count / $per_page);
		if($count>0)
		{
			if ($cur_page >= 7) {
				$start_loop = $cur_page - 3;
				if ($no_of_paginations > $cur_page + 3)
				$end_loop = $cur_page + 3;
				else if ($cur_page <= $no_of_paginations && $cur_page > $no_of_paginations - 6) {
	    			$start_loop = $no_of_paginations - 6;
	    			$end_loop = $no_of_paginations;
				} else {
	    			$end_loop = $no_of_paginations;
				}
			} else {
				$start_loop = 1;
				if ($no_of_paginations > 7)
	    		$end_loop = 7;
				else
	    		$end_loop = $no_of_paginations;
			}
			$msg .= "<ul class='pagination pagination-outline-secondary'>";
			if ($first_btn && $cur_page > 1) {
				//$msg .= "<li p='1' class='page-item'><a onclick='Pagination(1)' class='page-link' href='javascript:void(0)'>First</a>First</li>";
			} else if ($first_btn) {
				//$msg .= "<li p='1' class='page-item inactive'><a class='page-link' href='javascript:void(0)'>First</a></li>";
			}
			if ($previous_btn && $cur_page > 1) {
				$pre = $cur_page - 1;
				$msg .= "<li p='$pre' class='page-item'><a onclick='Pagination($pre)' class='page-link' href='javascript:void(0)'>Previous</a></li>";
			} else if ($previous_btn) {
				$msg .= "<li class='page-item inactive'><a class='page-link' href='javascript:void(0)'>Previous</a></li>";
			}
			for ($i = $start_loop; $i <= $end_loop; $i++) {
				if ($cur_page == $i)
	    		$msg .= "<li p='$i' class='page-item active'><a class='page-link' href='javascript:void(0)'>{$i}</a></li>";
				else
	    		$msg .= "<li p='$i' class='page-item'><a class='page-link' onclick='Pagination($i)' href='javascript:void(0)'>{$i}</a></li>";
				}
			    if ($next_btn && $cur_page < $no_of_paginations) {
			      $nex = $cur_page + 1;
			      $msg .= "<li p='$nex' class='page-item'><a onclick='Pagination($nex)' class='page-link' href='javascript:void(0)'>Next</a></li>";
			    } else if ($next_btn) {
			      $msg .= "<li class='page-item inactive'><a class='page-link' href='javascript:void(0)'>Next</a></li>";
			    }

				if ($last_btn && $cur_page < $no_of_paginations) {
					//$msg .= "<li p='$no_of_paginations' class='page-item active' onclick='Pagination($no_of_paginations)'>Last</li>";
				} else if ($last_btn) {
					//$msg .= "<li p='$no_of_paginations' class='page-item inactive'>Last</li>";
				}
				//$goto = "<input type='text' style='display:none;' class='goto' size='1' style='margin-top:-1px;margin-left:60px;'/><input type='button' id='go_btn' class='go_button' value='Go' style='display:none;'/>";
				/*$total_string = "<span class='total' a='$no_of_paginations'>(page<b>" . $cur_page . "</b> of <b>$no_of_paginations</b> )</span>";
				$msg = $msg . "</ul>" . $goto . $total_string . "</div>";*/
				//$msg = $msg . "</ul>" . $goto;
				$msg = $msg . "</ul>";
				return $msg;
		}
		else
		{
			return '<div class="col-md-12 text-center" style="color:red"><strong>No Record Found</strong></div>';
		}
	}
	public static function GenerateRandomId($length)
	{
    $id_length = $length;
    $alfa = "abcdefghijklmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZabcdefghijklmnpqrstuvwxyz";
    $token = "";
    for($i = 1; $i < $id_length; $i ++) {
      @$token .= $alfa[rand(1, strlen($alfa))];
    }
    return $token;
	}
	public static function DateDiff($From, $To){
		$diff = abs($From - $To);
    $years = floor($diff / (365*60*60*24));
    $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
    $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
    $Still = '';
    if($years!=0) $Still.=$years.' Years ';
    if($months!=0) $Still.=$months.' Months ';
    if($days!=0) $Still.=$days.' Days';
    return $Still;
	}
	public static function DateDiff2($From, $To)
	{
		$diff = abs(strtotime($From) - strtotime($To));
	    $years = floor($diff / (365*60*60*24));
	    $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
	    $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
	    $Still = '';
	    if($years!=0) $Still.=$years.' Years ';
	    if($months!=0) $Still.=$months.' Months ';
	    return $Still;
	}
	public static function GenerateOTP($length)
  {
    $characters = '0123456789876543210123456789876543210';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
      $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return "1234";
  }

  public static function limitTextWords($content = false, $limit = false, $stripTags = false, $ellipsis = false) 
	{
    if ($content && $limit) {
      $content = ($stripTags ? strip_tags($content) : $content);
      $content = explode(' ', $content, $limit+1);
      array_pop($content);
      if ($ellipsis) {
          array_push($content, '');
      }
      $content = implode(' ', $content);
    }
    return $content;
	}
	public function TimeElapsedString($datetime, $full = false) 
	{
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);
    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;
    $string = array(
	        'y' => 'year',
	        'm' => 'month',
	        'w' => 'week',
	        'd' => 'day',
	        'h' => 'hour',
	        'i' => 'minute',
	        's' => 'second',
	    	);
	  foreach ($string as $k => &$v) {
      if ($diff->$k) {
        $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
      } else {
        unset($string[$k]);
      }
	  }
    if (!$full) $string = array_slice($string, 0, 1);
	  return $string ? implode(', ', $string) . ' ago' : 'just now';
	}
	public static function DynamicPagination($numofrecords, $count, $page, $OnClick){
		$per_page = $numofrecords;
		$previous_btn = true;
		$next_btn = true;
		$first_btn = true;
		$last_btn = true;
		$start = $page * $per_page;
		$cur_page = $page;
		$msg = "";
		$no_of_paginations = ceil($count / $per_page);
		if($count>0)
		{
			if ($cur_page >= 7) {
				$start_loop = $cur_page - 3;
				if ($no_of_paginations > $cur_page + 3)
				$end_loop = $cur_page + 3;
				else if ($cur_page <= $no_of_paginations && $cur_page > $no_of_paginations - 6) {
	    			$start_loop = $no_of_paginations - 6;
	    			$end_loop = $no_of_paginations;
				} else {
	    			$end_loop = $no_of_paginations;
				}
			} else {
				$start_loop = 1;
				if ($no_of_paginations > 7)
	    		$end_loop = 7;
				else
	    		$end_loop = $no_of_paginations;
			}
			$msg .= "<ul class='pagination pagination-outline-secondary'>";
			if ($first_btn && $cur_page > 1) {
				//$msg .= "<li class='page-item'><a onclick='$OnClick(1)' class='page-link' href='javascript:void(0)'>First</a></li>";
			} else if ($first_btn) {
				//$msg .= "<li class='page-item inactive'><a class='page-link' href='javascript:void(0)'>First</a></li>";
			}
			if ($previous_btn && $cur_page > 1) {
				$pre = $cur_page - 1;
				$msg .= "<li p='$pre' class='page-item'><a onclick='$OnClick($pre)' class='page-link' href='javascript:void(0)'>Previous</a></li>";
			} else if ($previous_btn) {
				$msg .= "<li class='page-item inactive'><a class='page-link' href='javascript:void(0)'>Previous</a></li>";
			}
			for ($i = $start_loop; $i <= $end_loop; $i++) {
				if ($cur_page == $i)
	    		$msg .= "<li p='$i' class='page-item active'><a class='page-link' href='javascript:void(0)'>{$i}</a></li>";
				else
	    		$msg .= "<li p='$i' class='page-item'><a class='page-link' onclick='$OnClick($i)' href='javascript:void(0)'>{$i}</a></li>";
				}
			    if ($next_btn && $cur_page < $no_of_paginations) {
			      $nex = $cur_page + 1;
			      $msg .= "<li class='page-item'><a onclick='$OnClick($nex)' class='page-link' href='javascript:void(0)'>Next</a></li>";
			    } else if ($next_btn) {
			      $msg .= "<li class='page-item inactive'><a class='page-link' href='javascript:void(0)'>Next</a></li>";
			    }

				if ($last_btn && $cur_page < $no_of_paginations) {
					//$msg .= "<li p='$no_of_paginations' class='page-item'><a class='page-link' href='javascript:void(0)' onclick='$OnClick($no_of_paginations)'>Last</a></li>";
				} else if ($last_btn) {
					//$msg .= "<li class='page-item inactive'><a class='page-link' href='javascript:void(0)'>Last</a></li>";
				}
				$msg = $msg . "</ul>";
				return $msg;
		}
		else
		{
			return '<div class="col-md-12 text-center" style="color:red"><strong>No Record Found</strong></div>';
		}
	}

	public static function get_client_ip(){
	  $ipaddress = '';
	  if (getenv('HTTP_CLIENT_IP'))
	    $ipaddress = getenv('HTTP_CLIENT_IP');
	  else if(getenv('HTTP_X_FORWARDED_FOR'))
	    $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
	  else if(getenv('HTTP_X_FORWARDED'))
	    $ipaddress = getenv('HTTP_X_FORWARDED');
	  else if(getenv('HTTP_FORWARDED_FOR'))
	    $ipaddress = getenv('HTTP_FORWARDED_FOR');
	  else if(getenv('HTTP_FORWARDED'))
	    $ipaddress = getenv('HTTP_FORWARDED');
	  else if(getenv('REMOTE_ADDR'))
	    $ipaddress = getenv('REMOTE_ADDR');
	  else
	    $ipaddress = 'UNKNOWN';
	  return $ipaddress;
	} 
	
}