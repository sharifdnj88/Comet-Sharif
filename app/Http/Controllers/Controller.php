<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Youtube and Vimeo video link conversion
     */
    public function embed($link ='')
    {

        if( strpos( $link, 'vimeo.com' ) ){
            $arr = explode( 'vimeo.com/', $link );
            $id = $arr[1];
            return "https://player.vimeo.com/video/{$id}";
        }else{
            $link_embed = str_replace('watch?v=', 'embed/', $link);
            if( $link_arr = '&list' ){
                $link_arr = explode('&list', $link_embed);
                    return $link_arr[0];
            }elseif( $link_arr = '&t' ){
                $link_arr = explode('&t', $link_embed);
                    return $link_arr[0];
            }  
        }
    
    }

    /**
     * Slug Make
     */
    public function slugMaker($title)
    {
        $lower = strtolower($title);
        return str_replace(' ', '-', $lower);
    }

}
