//http://pure-essence.net/2013/10/25/how-i-made-tiny-carousel-swipeable/
var mdp = {};
(function (mdp) {
  var carouselNav = function (carouselSelector, options) {
    var defaults = {
      viewportSelector: '.carouselNav__listWrapper',
      listSelector: '.carouselNav__list',
      prevSelector: '.carouselNav__prev',
      nextSelector: '.carouselNav__next',
      firstClass: 'carouselNav--first',
      lastClass: 'carouselNav--last',
      itemSelector: 'li',
      selectedSelector: '.carouselNav__listItem--selected',
      scrollAnimationDuration: 500, // ms
      defaultScrollDistance: 200,
      offset: 20,
    };

    if (options) {
      // Allow option overrides.
      options = Object.assign(defaults, options);
    }
    else {
      options = defaults;
    }
    
    function offset(elt) {
      var rect = elt.getBoundingClientRect(), bodyElt = document.body;

      return {
        top: rect.top + bodyElt.scrollTop,
        left: rect.left + bodyElt.scrollLeft
      }
    }
    
    // Robert Penner's easeInOutQuad - http://robertpenner.com/easing/
    function easeInOutQuad(t, b, c, d)  {
      t /= d / 2;
      if(t < 1) {
        return c / 2 * t * t + b;
      }
      t--;
      return -c / 2 * (t * (t - 2) - 1) + b;
    }
    
    function CarouselSwipeable(root, options) {
      var wrapper = root.querySelector(options.listSelector);
      var selectedElement = wrapper.querySelector(options.selectedSelector);
      var items = wrapper.querySelectorAll(options.itemSelector);
      var minItem = items[0];
      var maxItem = items[items.length - 1];

      root.classList.remove(options.firstClass);
      root.classList.remove(options.lastClass);

      if (selectedElement) {
        if (minItem !== selectedElement) {
          var childPos = offset(selectedElement);
          var parentPos = offset(wrapper);
          var childOffset = {
            left: childPos.left - parentPos.left
          };

          var startPos = childOffset.left;
          if (maxItem !== selectedElement) {
            startPos = startPos - options.offset;
          }
          scroll('right', wrapper, startPos);
        }
        else {
          root.classList.add(options.firstClass);
        }
      }
      else {
        checkEnds();
      }

      var scrollDone;
      wrapper.addEventListener('scroll', function () {
        clearTimeout(scrollDone);
        scrollDone = setTimeout(checkEnds, 100);
      });
      
      var resizeDone;
      window.addEventListener('resize', function() {
        clearTimeout(resizeDone);
        resizeDone = setTimeout(checkEnds, 500);
      });
      root.querySelector(options.prevSelector).addEventListener('click', function (e) {
        e.preventDefault();
        e.stopPropagation();
        scroll('left', wrapper, getDistance());
      });
      root.querySelector(options.nextSelector).addEventListener('click', function (e) {
        e.preventDefault();
        e.stopPropagation();
        scroll('right', wrapper, getDistance());
      });

      function scroll(direction, innerWrapper, distance) {
        if (!distance) {
          distance = options.defaultScrollDistance;
        }
        
        if ('left' === direction) {
          distance = -distance;
        }

        smoothScroll(innerWrapper, distance);
      }

      function checkEnds() {
        root.classList.remove(options.firstClass);
        root.classList.remove(options.lastClass);
        markFirst();
        markLast();
      }

      function markFirst() {
        var viewport = root.querySelector(options.viewportSelector);
        var minItemOffsetLeft = offset(minItem).left;
        var minItemPositionLeft = minItemOffsetLeft - offset(viewport).left;
        if (minItemPositionLeft >= 0) {
          root.classList.add(options.firstClass);
        }
      }

      function markLast() {
        var viewport = root.querySelector(options.viewportSelector);
        var maxItemOffsetLeft = offset(maxItem).left;
        var maxItemPositionLeft = maxItemOffsetLeft - offset(viewport).left + maxItem.offsetWidth;
        if (maxItemPositionLeft <= viewport.offsetWidth) {
          root.classList.add(options.lastClass);
        }
      }

      function getDistance() {
        var viewport = root.querySelector(options.viewportSelector);
        return viewport.offsetWidth - options.offset;
      }
      
      // Inspired by https://github.com/sitepoint-editors/smooth-scrolling/blob/gh-pages/jump.js
      function smoothScroll(wrapper, scrollDistance) {
        var start = wrapper.scrollLeft;
        var distance = scrollDistance;
        var duration = options.scrollAnimationDuration;
        var timeStart, timeElapsed;
        
        requestAnimationFrame(function(time) { timeStart = time; loop(time); });

        function loop(time) {
          timeElapsed = time - timeStart;

          wrapper.scrollLeft = easeInOutQuad(timeElapsed, start, distance, duration);

          if (timeElapsed < duration) {
            requestAnimationFrame(loop);
          }
          else {
            end();
          }
        }

        function end() {
          wrapper.scrollLeft = start + distance;
          checkEnds();
        }
      }
    }
    
    var carousels = document.querySelectorAll(carouselSelector);
    for (var i = 0; i < carousels.length; i++) {
      var carousel = carousels[i];
      new CarouselSwipeable(carousel, options);
    }
  };

  mdp.carouselNav = carouselNav;
  mdp.carouselNav('#carouselNav');
})(mdp || {});

