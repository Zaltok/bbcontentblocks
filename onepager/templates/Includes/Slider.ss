<div id="rev_slider_17_1_wrapper" class="rev_slider_wrapper fullscreen-container" data-alias="fullscreen-button1"
     style="background-color:transparent;padding:0px;">
    <!-- START REVOLUTION SLIDER 5.2.5.4 fullscreen mode -->
    <div id="rev_slider_17_1" class="rev_slider fullscreenbanner" style="display:none;" data-version="5.2.5.4">
        <ul>
            <% loop $Slider %>
                <!-- SLIDE  -->
                <li data-index="rs-{$$ID}" data-transition="zoomin" data-slotamount="7" data-hideafterloop="0"
                    data-hideslideonmobile="off" data-easein="Power4.easeInOut" data-easeout="Power4.easeInOut"
                    data-masterspeed="2000" data-thumb="{$Image.Filename}" data-rotate="0"
                    data-saveperformance="off" data-title="{$Title}" data-param1="" data-param2="" data-param3=""
                    data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9=""
                    data-param10="" data-description="">
                    <!-- MAIN IMAGE -->
                    <img src="{$Image.Filename}" alt="" data-bgposition="center center" data-kenburns="on"
                         data-duration="30000" data-ease="Linear.easeNone" data-scalestart="100" data-scaleend="110"
                         data-rotatestart="0" data-rotateend="0" data-offsetstart="-500 0" data-offsetend="500 0"
                         data-bgparallax="10" class="rev-slidebg" data-no-retina>
                    <!-- LAYERS -->

                    <% if $ShowTitleInSlide %>
                        <div class="tp-caption NotGeneric-Title   tp-resizeme rs-parallaxlevel-0 splitted"
                             id="slide-{$ID}-layer-1" data-x="['center','center','center','center']"
                             data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']"
                             data-voffset="['0','0','0','0']" data-fontsize="['70','70','70','45']"
                             data-lineheight="['70','70','70','50']" data-fontweight="['600','800','800','800']"
                             data-width="none" data-height="none" data-whitespace="nowrap" data-transform_idle="o:1;"
                             data-transform_in="y:[-100%];z:0;rZ:35deg;sX:1;sY:1;skX:0;skY:0;s:2000;e:Power4.easeInOut;"
                             data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;" data-mask_in="x:0px;y:0px;"
                             data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;" data-start="1000"
                             data-splitin="chars" data-splitout="none" data-responsive_offset="on"
                             data-elementdelay="0.05"
                             style="z-index: 5; white-space: nowrap; font-weight: 600;color:#fff;">$Title</div>
                    <% end_if %>
                </li>
            <% end_loop %>

        </ul>
        <div class="tp-bannertimer" style="height: 7px; background-color: rgba(255, 255, 255, 0.25);"></div>
    </div>
</div>