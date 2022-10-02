<!DOCTYPE html>
<html lang="en">
    

<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <title>@yield('title', 'Office Management')</title>
		
		<!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">

		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
		
		<!-- Fontawesome CSS -->
        <link rel="stylesheet" href="{{asset('assets/css/font-awesome.min.css')}}">

        <!-- Feathericon CSS -->
        <link rel="stylesheet" href="{{asset('assets/css/feathericon.min.css')}}">
		
		<!-- Main CSS -->
        <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
        
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.12.1/datatables.min.css"/>
        
        {{-- Themefi icon --}}
        <link rel="stylesheet" href="{{asset('assets/icon/themify-icons.css')}}">

        {{-- Select-2 --}}
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
		

    </head>
    <body>



        @section('main')            
        @show






		
		<!-- jQuery -->
        <script src="{{asset('assets/js/jquery-3.2.1.min.js')}}"></script>
		
		<!-- Bootstrap Core JS -->
        <script src="{{asset('assets/js/popper.min.js')}}"></script>
        <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>

        <!-- Slimscroll JS -->
        <script src="{{asset('assets/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>
		
		<script src="{{asset('assets/plugins/raphael/raphael.min.js')}}"></script>    
		<script src="{{asset('assets/plugins/morris/morris.min.js')}}"></script>  
		<script src="{{asset('assets/js/chart.morris.js')}}"></script>
		
		<!-- Custom JS -->
		<script src="{{asset('assets/js/script.js')}}"></script>

        
        <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.12.1/datatables.min.js"></script>

        {{-- CK Editor --}}
        <script src="//cdn.ckeditor.com/4.19.1/basic/ckeditor.js"></script>
        
		<script src="{{asset('assets/js/custom.js')}}"></script>

        {{-- Selece-2 --}}
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>




        {{-- Delete BTN Alert Start--}}
        <script>			
            (function($){
            
            $('.delete-btn').click(function(){
                let conf = confirm('Are you Sure Delete this Data ?');
                if (conf) {
                    return true;
                }else{
                    return false;
                }
            });
            
            })(jQuery)
            </script>
            {{-- Delete BTN Alert End--}}

            {{-- Photo Preview Start --}}
            <script>
                (function($){
                    // Slider Photo Preview
                $('#slider-photo').change(function(e){
                    const photo_url = URL.createObjectURL(e.target.files[0]);
                    $('#slider-photo-preview').attr('src', photo_url);
                    $('#slider-photo-preview').css('border-radius', '5%');
                    $('#slider-photo-preview').css('border', '3px solid red');
                    $('#slider-photo-preview').css('padding', '5px');
                    $('#slider-photo-preview').css('box-shadow', '0px 0px 10px 0px rgba(0,0,0,0.5)');
                });
                })(jQuery)
            </script>
            {{-- Photo Preview End --}}
            
            {{-- Slider Add BTN Start --}}
            <script>
                (function($){

                // add_new_slider_btn
                    let btn_no = 1;
                $('#add_new_slider_btn').click(function(e){
                    e.preventDefault();
                    $('.slider-btn-opt').append(`
                        <div class="btn-opt-area">
                            <div class="d-flex justify-content-between">
                                <span class="font-weight-bold btn btn-sm btn-info mb-2">Button  <span class="text-warning"> >> </span> ${btn_no }</span>
                                <span class="text-danger remove_btn" style="cursor:pointer"><i class="fa fa-times-rectangle-o"></i></span>    
                            </div>
                            <input name="btn_title[]" class="form-control mb-3" type="text" placeholder="Button Title">
                            <input name="btn_link[]" class="form-control mb-4" type="text" placeholder="Button Link">
                           
                            <select name="btn_type[]" class="form-control">
                                <option value="btn-light-out">Default</option>    
                                <option value="btn-color btn-full">Red</option>    
                            </select>
                            <hr>
                        </div>
                    `);
                    btn_no ++;               

                });

                 // Remove BTN
                 $(document).on('click', '.remove_btn', function(){
                    $(this).closest('.btn-opt-area').remove();
                 });                

                })(jQuery)
            </script>
            {{-- Slider Add BTN End --}}

            {{-- Vision Button Start --}}
            <script>
                (function($){

                     let vbtn_no = 1;
                    $('#add_vision_btn').click(function(e){
                        e.preventDefault();
                        $('.vision-btn-opt').append(`
                            <div class="btn-opt-area">
                                <div class="d-flex justify-content-between">
                                    <span class="font-weight-bold btn btn-sm btn-info mb-2">Button  <span class="text-warning"> >> </span> ${vbtn_no} </span>
                                    <span class="text-danger remove_btn" style="cursor:pointer"><i class="fa fa-times-rectangle-o"></i></span>    
                                </div>
                                <input name="vision_name[]" type="text" class="form-control mb-2" placeholder="Vision Name">
                                <input name="vision_desc[]" type="text" class="form-control mb-2" placeholder="Vision Description">
                            </div>  
                        `);
                        vbtn_no++;
                    });


                })(jQuery)
            </script>
            {{-- Vision Button End --}}

            <script>
                (function($){
                    $('button#show-icon').click(function(e){
                        e.preventDefault();
                        $('#icon-select').modal('show');
                    });

                    // select icon
                    $('.icon-select-said .preview-icon').click(function(){
                        let icon_name = $(this).find('i').attr('class');
                        $('.select-icon-input').val(icon_name);
                        $('#icon-select').modal('hide');
                    });


                })(jQuery)
            </script>

            <script>
                (function($){
                    $('#portfolio-gallery').change(function(e){
                        const files = e.target.files;
                        let gallery_ui    = '';

                        for( let i = 0; i < files.length; i ++  ){
                            const ob_url = URL.createObjectURL(files[i]);
                            gallery_ui += ` <img src="${ob_url}" > `;
                        }

                        $('.port-gall').append(gallery_ui);

                    });

                })(jQuery)
            </script>

            {{-- CK Editor --}}
            <script>
                (function($){
                    CKEDITOR.replace( 'portfolio-desc' );

                })(jQuery)
            </script>

            {{-- Select -2 --}}
            <script>
                (function($){
                    $('.comet-select').select2();
                })(jQuery)
            </script>

            {{-- post type selector --}}
            <script>
                (function($){
                    $('#post-type-selector').change(function(){
                        const type = $(this).val();
                        
                        if( type == 'Standard' ){
                            $('.post-standard').show();
                            $('.post-gallery').hide();
                            $('.post-video').hide();
                            $('.post-audio').hide();
                            $('.post-quote').hide();
                        }else if( type == 'Gallery' ){
                            $('.post-standard').hide();
                            $('.post-gallery').show();
                            $('.post-video').hide();
                            $('.post-audio').hide();
                            $('.post-quote').hide();
                        }else if( type == 'Video' ){
                            $('.post-standard').hide();
                            $('.post-gallery').hide();
                            $('.post-video').show();
                            $('.post-audio').hide();
                            $('.post-quote').hide();
                        }else if( type == 'Audio' ){
                            $('.post-standard').hide();
                            $('.post-gallery').hide();
                            $('.post-video').hide();
                            $('.post-audio').show();
                            $('.post-quote').hide();
                        }else if( type == 'Quote' ){
                            $('.post-standard').hide();
                            $('.post-gallery').hide();
                            $('.post-video').hide();
                            $('.post-audio').hide();
                            $('.post-quote').show();
                        }

                    });
                })(jQuery)
            </script>
		
    </body>
</html>