# default

$(document).ready ->

  # svg fallback
  if !Modernizr.svg
    imgs = $('img[data-fallback]')
    imgs.attr 'src', imgs.data('fallback')

  # svg replace
  jQuery('img.svg-replace').each ->
    $img = jQuery(this)
    imgID = $img.attr('id')
    imgClass = $img.attr('class')
    imgURL = $img.attr('src')
    jQuery.get imgURL, ((data) ->
      # Get the SVG tag, ignore the rest
      $svg = jQuery(data).find('svg')
      # Add replaced image's ID to the new SVG
      if typeof imgID != 'undefined'
        $svg = $svg.attr('id', imgID)
      # Add replaced image's classes to the new SVG
      if typeof imgClass != 'undefined'
        $svg = $svg.attr('class', imgClass + ' replaced-svg')
      # Remove any invalid XML tags as per http://validator.w3.org
      $svg = $svg.removeAttr('xmlns:a')
      # Replace image with new SVG
      $btn = jQuery "<div class='replaced-svg-container'>"
      $btn.append $svg
      $img.parent().prepend $btn
      $img.hide()
      return
    ), 'xml'
    return


# Google map
gmap_container = 'map-canvas-general'
if $('#' + gmap_container).length
  initialize = ->
    styles = [
      { stylers: [
        { hue: '#00ffe6' }
        { saturation: -100 }
      ] }
      {
        featureType: 'road'
        elementType: 'geometry'
        stylers: [
          { lightness: 0 }
          { 'gamma': 1.18 }
          { visibility: 'simplified' }
        ]
      }
      {
        featureType: 'road'
        elementType: 'labels'
        stylers: [ { visibility: 'off' } ]
      }
    ]
    styledMap = new (google.maps.StyledMapType)(styles, name: 'Styled Map')
    image = '/images/frontend/static/map/map-marker.png'
    #Map marker - image location
    myLatlng = new (google.maps.LatLng)(50.468376, 4.987975)
    #Your location
    mapOptions =
      zoom: 10
      scrollwheel: false
      center: myLatlng
      mapTypeControlOptions: mapTypeIds: [
        google.maps.MapTypeId.ROADMAP
        'map_style'
      ]
    map = new (google.maps.Map)(document.getElementById(gmap_container), mapOptions)
    marker = new (google.maps.Marker)(
      position: myLatlng
      map: map
      icon: image
      title: 'Construct-Tim')
    #Associate the styled map with the MapTypeId and set it to display.
    map.mapTypes.set 'map_style', styledMap
    map.setMapTypeId 'map_style'
    return

  google.maps.event.addDomListener window, 'load', initialize
