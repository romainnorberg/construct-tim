initPhotoSwipeFromDOM = (gallerySelector) ->

  # parse slide data (url, title, size ...) from DOM elements
  # (children of gallerySelector)
  parseThumbnailElements = (el) ->
    thumbElements = el.childNodes
    numNodes = thumbElements.length
    items = []
    figureEl = undefined
    linkEl = undefined
    size = undefined
    item = undefined
    i = 0

    while i < numNodes
      figureEl = thumbElements[i] # <figure> element

      # include only element nodes
      continue  if figureEl.nodeType isnt 1
      linkEl = figureEl.children[0] # <a> element
      size = linkEl.getAttribute("data-size").split("x")

      # create slide object
      item =
        src: linkEl.getAttribute("href")
        w: parseInt(size[0], 10)
        h: parseInt(size[1], 10)


      # <figcaption> content
      item.title = figureEl.children[1].innerHTML  if figureEl.children.length > 1

      # <img> thumbnail element, retrieving thumbnail url
      item.msrc = linkEl.children[0].getAttribute("src")  if linkEl.children.length > 0
      item.pid = linkEl.getAttribute("pid")
      item.el = figureEl # save link to element for getThumbBoundsFn
      items.push item
      i++
    # console.log items
    items


  # find nearest parent element
  closest = closest = (el, fn) ->
    el and ((if fn(el) then el else closest(el.parentNode, fn)))


  # triggers when user clicks on thumbnail
  onThumbnailsClick = (e) ->
    e = e or window.event
    (if e.preventDefault then e.preventDefault() else e.returnValue = false)
    eTarget = e.target or e.srcElement

    # find root element of slide
    clickedListItem = closest(eTarget, (el) ->
      el.tagName and el.tagName.toUpperCase() is "FIGURE"
    )
    return  unless clickedListItem

    # find index of clicked item by looping through all child nodes
    # alternatively, you may define index via data- attribute
    clickedGallery = clickedListItem.parentNode
    childNodes = clickedListItem.parentNode.childNodes
    numChildNodes = childNodes.length
    nodeIndex = 0
    index = undefined
    i = 0

    while i < numChildNodes
      continue  if childNodes[i].nodeType isnt 1
      if childNodes[i] is clickedListItem
        index = nodeIndex
        break
      nodeIndex++
      i++

    # open PhotoSwipe if valid index found
    openPhotoSwipe index, clickedGallery  if index >= 0
    false


  # parse picture index and gallery index from URL (#&pid=1&gid=2)
  photoswipeParseHash = ->
    hash = window.location.hash.substring(1)
    params = {}
    return params  if hash.length < 5
    vars = hash.split("&")
    i = 0

    #console.log hash
    #console.log vars.length
    while i < vars.length
      i++
      continue  unless vars[i]
      pair = vars[i].split("=")
      continue  if pair.length < 2
      params[pair[0]] = pair[1]

    params.gid = parseInt(params.gid, 10)  if params.gid

    return params

  openPhotoSwipe = (index, galleryElement, disableAnimation, fromURL) ->
    pswpElement = document.querySelectorAll(".pswp")[0]
    gallery = undefined
    options = undefined
    items = undefined
    items = parseThumbnailElements(galleryElement)

    # define options (if needed)
    options =

      # define gallery index (for URL)
      galleryUID: galleryElement.getAttribute("data-pswp-uid")
      galleryPIDs: true
      getThumbBoundsFn: (index) ->

        # See Options -> getThumbBoundsFn section of documentation for more info
        thumbnail = items[index].el.getElementsByTagName("img")[0] # find thumbnail
        pageYScroll = window.pageYOffset or document.documentElement.scrollTop
        rect = thumbnail.getBoundingClientRect()
        x: rect.left
        y: rect.top + pageYScroll
        w: rect.width

    # PhotoSwipe opened from URL
    if fromURL
      if options.galleryPIDs

        # parse real index when custom PIDs are used
        # http://photoswipe.com/documentation/faq.html#custom-pid-in-url
        j = 0

        while j < items.length
          if items[j].pid is index
            options.index = j
            break
          j++
      else

        # in URL indexes start from 1
        options.index = parseInt(index, 10) - 1
    else
      options.index = parseInt(index, 10)

    # exit if index not found
    return  if isNaN(options.index)
    options.showAnimationDuration = 0  if disableAnimation

    # Pass data to PhotoSwipe and initialize it
    gallery = new PhotoSwipe(pswpElement, PhotoSwipeUI_Default, items, options)
    gallery.init()


  # loop through all gallery elements and bind events
  galleryElements = document.querySelectorAll(gallerySelector)
  i = 0
  l = galleryElements.length

  while i < l
    galleryElements[i].setAttribute "data-pswp-uid", i + 1
    galleryElements[i].onclick = onThumbnailsClick
    i++

  # Parse URL and open gallery if it contains #&pid=3&gid=1
  hashData = photoswipeParseHash()
  openPhotoSwipe hashData.pid, galleryElements[hashData.gid - 1], true, true  if hashData.pid and hashData.gid


# execute above function
$(document).ready ->
  initPhotoSwipeFromDOM ".my-gallery"

# with turbo links
#$(document).on 'page:load', initPhotoSwipeFromDOM('.my-gallery')


# scroll
$(window).scroll ->
  if $(document).scrollTop() > $(window).height()
    $('.navbar').addClass 'navbar-fixed-top'
    $('section#ZCarousel').css 'margin-bottom', (80+15)
  else
    $('.navbar').removeClass 'navbar-fixed-top'
    $('section#ZCarousel').css 'margin-bottom', 0
  return

# slider
$(document).ready ->
  $('.carousel').carousel interval: 8000
  clickEvent = false
  $('.carousel').on 'slid.bs.carousel', (e) ->
      # if !clickEvent
        # console.log 'ok'

      clickEvent = false
      return
    return
