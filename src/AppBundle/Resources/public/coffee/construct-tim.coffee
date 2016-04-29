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
