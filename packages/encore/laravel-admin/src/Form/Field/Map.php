<?php

namespace Encore\Admin\Form\Field;

use Encore\Admin\Form\Field;

class Map extends Field
{
    /**
     * Column name.
     *
     * @var string
     */
    protected $column = [];

    /**
     * Get assets required by this field.
     *
     * @return array
     */
    public static function getAssets()
    {
        if (config('app.locale') == 'zh_CN') {
            $js = 'http://map.qq.com/api/js?v=2.exp';
        } else {
            $js = 'https://maps.googleapis.com/maps/api/js?v=3.exp&key='.env('GOOGLE_API_KEY');
        }

        return compact('js');
    }

    public function __construct($column, $arguments)
    {
        $this->column['lat'] = $column;
        $this->column['lng'] = $arguments[0];

        array_shift($arguments);

        $this->label = $this->formatLabel($arguments);
        $this->id = $this->formatId($this->column);

        /*
         * Google map is blocked in mainland China
         * people in China can use Tencent map instead(;
         */
        if (config('app.locale') == 'zh_CN') {
            $this->useTencentMap();
        } else {
            $this->useGoogleMap();
        }
    }

    public function useGoogleMap()
    {
        $this->script = <<<EOT
        function initGoogleMap(name) {
            var lat = $('#{$this->id['lat']}');
            var lng = $('#{$this->id['lng']}');

            var LatLng = new google.maps.LatLng(lat.val(), lng.val());

            var options = {
                zoom: 13,
                center: LatLng,
                panControl: false,
                zoomControl: true,
                scaleControl: true,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            }

            var container = document.getElementById("map_"+name);
            var map = new google.maps.Map(container, options);

            var marker = new google.maps.Marker({
                position: LatLng,
                map: map,
                title: 'Drag Me!',
                draggable: true
            });

            google.maps.event.addListener(marker, 'dragend', function (event) {
                lat.val(event.latLng.lat());
                lng.val(event.latLng.lng());
            });
        }

        initGoogleMap('{$this->id['lat']}{$this->id['lng']}');
EOT;
    }

    public function useTencentMap()
    {
        $this->script = <<<EOT
        function initTencentMap(name) {
            var lat = $('#{$this->id['lat']}');
            var lng = $('#{$this->id['lng']}');

            var center = new qq.maps.LatLng(lat.val(), lng.val());

            var container = document.getElementById("map_"+name);
            var map = new qq.maps.Map(container, {
                center: center,
                zoom: 13
            });

            var marker = new qq.maps.Marker({
                position: center,
                draggable: true,
                map: map
            });

            if( ! lat.val() || ! lng.val()) {
                var citylocation = new qq.maps.CityService({
                    complete : function(result){
                        map.setCenter(result.detail.latLng);
                        marker.setPosition(result.detail.latLng);
                    }
                });

                citylocation.searchLocalCity();
            }

            qq.maps.event.addListener(map, 'click', function(event) {
                marker.setPosition(event.latLng);
            });

            qq.maps.event.addListener(marker, 'position_changed', function(event) {
                var position = marker.getPosition();
                lat.val(position.getLat());
                lng.val(position.getLng());
            });
        }

        initTencentMap('{$this->id['lat']}{$this->id['lng']}');
EOT;
    }
}
