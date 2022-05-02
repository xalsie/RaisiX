(function(angular) {
  'use strict';
  var app = angular.module('appRoot', []);

  // config tmdb
  var tmdbConf = {
    api_key: "9a669d07e76293279b1bfa0e023610ed",
    base_uri: "https://api.themoviedb.org/3/",
    images_uri: "https://image.tmdb.org/t/p/original",
    language: "fr-FR",
    timeout: 5000
  };

  app.filter('iframeVideoYtb', ['$sce', function ($sce) {
    return function (val) {
      return $sce.trustAsResourceUrl("https://www.youtube-nocookie.com/embed/"+val);
    };
  }]);

  app.filter('displayGenres', function() {
    return function (genres, seperator) {
      if (genres == undefined) return "";
      const obj = JSON.parse(genres);
      const count = Object.keys(obj).length;
      var _rtn = "";
      for (var key in obj) {
        if (key != count-1)
          _rtn += obj[key].name+seperator;
        else
          _rtn += obj[key].name;
      }
      return _rtn;
    }
  });

  app.filter('fromNow', function() {
    return function (x) {
      return moment(x, "YYYY-MM-DD hh:mm:ss").fromNow();
    }
  });

  app.filter('formatTime', function() {
    return function (date) {
      if (date == undefined) return "";
      const h = Math.floor(date / 60);
      const m = Math.round(date % 60)
      return [
        h, "h ",
        m > 9 ? m : (h ? '0' + m : m || '0'), "m"
      ].filter(Boolean).join("");
    }
  });

  app.controller('getInfoNav', ['$scope', '$http', '$interval', function($scope, $http, $interval) {
    $scope.getAvatar = () => {
      $http({
        headers: {'Content-Type': 'application/json'},
        method: "POST",
        url: "/assets/js/app-server.php",
        dataType: 'json',
        data: {
          autofunc: true,
          action: "getAvatar",
        },
        async: true
      }).then(function (response) {
        $scope.avatar = response.data[0].avatar;
      });
    }

    /* -------------------------------------
      Get Notification
    ------------------------------------- */
    $scope.getDatasNotifs = () => {
      $http({
        headers: {'Content-Type': 'application/json'},
        method: "POST",
        url: "/assets/js/app-server.php",
        dataType: 'json',
        data: {
          autofunc: true,
          action: "getDatasNotifs",
        },
        async: true
      }).then(function (response) {
        $scope.notifMap = response.data.notification;
      });
    }

    $scope.getAvatar();

    $interval(()=>{$scope.getDatasNotifs()}, 3000); // TypeError: g is not a function
  }]);

  app.controller('appHeader', ['$scope', '$timeout', '$http', function($scope, $timeout, $http) {
    /* -------------------------------------
      Get Slider Picture
    ------------------------------------- */
    $scope.getDatasSlider = () => {
      $http({
        headers: {'Content-Type': 'application/json'},
        method: "POST",
        url: "/assets/js/app-server.php",
        dataType: 'json',
        data: {
          autofunc: true,
          action: "getDatasSlider",
        },
        async: true
      }).then(function (response) {
        $scope.sliderMap = response.data.slider;

        $timeout(function(){
          $scope.initSlider();
        }, 100);
      });
    }

    $scope.getUpcomingMovies = () => {
      $http({
        headers: {'Content-Type': 'application/json'},
        method: "POST",
        url: "/assets/js/app-server.php",
        dataType: 'json',
        data: {
          autofunc: true,
          action: "getUpcomingMovies",
        },
        async: true
      }).then(function (response) {
        $scope.upComingMovies = response.data.upComingMovies;

        $timeout(function(){
          $scope.initSliderByClass('.upcoming-slider');
        }, 100);
      });
    }

    $scope.getMovies = () => {
      $http({
        headers: {'Content-Type': 'application/json'},
        method: "POST",
        url: "/assets/js/app-server.php",
        dataType: 'json',
        data: {
          autofunc: true,
          action: "getMovies",
        },
        async: true
      }).then(function (response) {
        $scope.moviesList = response.data.moviesList;

        $timeout(function(){
          $scope.initSliderByClass('.movie-list-slider');
        }, 100);

        // $scope.toMovieSlider();
      });
    }

    $scope.responseMap    = false;
    $scope.notifMap       = [];
    $scope.sliderMap      = [];
    $scope.slideLoaded    = false;
    $scope.upComingMovies = [];
    $scope.moviesList     = [];

    $scope.initSlider = () => {
      /*---------------------------------------------------------------------
        Slick Slider
      ----------------------------------------------------------------------- */
      $('#home-slider').slick({
        lazyLoad: 'ondemand',
        autoplay: true,
        autoplaySpeed: 5000,
        speed: 800,
        slidesToShow: 1,
        slidesToScroll: 1,
        adaptiveHeight: false,
        infinite: true,
        dots: false,
        arrows: true,
        prevArrow: '<div class="slick-nav prev-arrow"><i></i><svg><use xlink:href="#circle"></svg></div>',
        nextArrow: '<div class="slick-nav next-arrow"><i></i><svg><use xlink:href="#circle"></svg></div>',
        swipe: true,
        swipeToSlide: true,
        responsive: [
          {
            breakpoint: 992,
            settings: {
              dots: true,
              arrows: false,
            }
          }
        ]
      }).slickAnimation();

      /*---------------------------------------------------------------------
        Video popup
      -----------------------------------------------------------------------*/
      $('.video-open').magnificPopup({
        type: 'iframe',
        mainClass: 'mfp-fade',
        removalDelay: 160,
        preloader: false,
        fixedContentPos: false,
        iframe: {
          markup: '<div class="mfp-iframe-scaler">' +
            '<div class="mfp-close"></div>' +
            '<iframe class="mfp-iframe" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>' +
            '</div>',
          srcAction: 'iframe_src',
        }
      });

      $scope.slideLoaded = true;
    }

    $scope.initSliderByClass = (className) => {
      $('.favorites-slider').slick({
        lazyLoad: 'ondemand',
        dots: false,
        arrows: true,
        prevArrow: '<div class="slick-nav prev-arrow"><i></i><svg><use xlink:href="#circle"></svg></div>',
        nextArrow: '<div class="slick-nav next-arrow"><i></i><svg><use xlink:href="#circle"></svg></div>',
        infinite: true,
        speed: 1500,
        autoplay: true,
        autoplaySpeed: 2500,
        slidesToShow: 4,
        slidesToScroll: 1,
        responsive: [
        {
          breakpoint: 1200,
          settings: {
          slidesToShow: 3,
          slidesToScroll: 1,
          infinite: true,
          dots: true
          }
        },
        {
          breakpoint: 768,
          settings: {
          slidesToShow: 2,
          slidesToScroll: 1,
          infinite: true,
          dots: true
          }
        },
        {
          breakpoint: 480,
          settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
          infinite: true,
          dots: true
          }
        }
        ]
      });

      $('.slick-nav').on('click touch', function (e) {
        e.preventDefault();
        var arrow = $(this);
        if (!arrow.hasClass('animate')) {
          arrow.addClass('animate');
          setTimeout(() => {
            arrow.removeClass('animate');
          }, 1600);
        }
      });
    }

    $scope.fromNow = (x) => {
      return moment(x, "YYYY-MM-DD hh:mm:ss").fromNow();
    }
    $scope.formatTime = (x) => {
      if (x == undefined) return "";
      const h = Math.floor(x / 60);
      const m = Math.round(x % 60)
      return [
        h, "h ",
        m > 9 ? m : (h ? '0' + m : m || '0'), "m"
      ].filter(Boolean).join("");
    }
    $scope.displayGenres = (genres, seperator) => {
      const obj = JSON.parse(genres);
      const count = Object.keys(obj).length;
      var _rtn = "";
      for (var key in obj) {
        if (key != count-1)
          _rtn += obj[key].name+seperator;
        else
          _rtn += obj[key].name;
      }
      return _rtn;
    }

    // scope tmdb
    $scope.tmdbConf = tmdbConf;
  }]);

  app.controller('appMovieDetail', ['$scope', '$timeout', '$http', function($scope, $timeout, $http) {
    $scope.getMovieById = (id) => {
      $http({
        headers: {'Content-Type': 'application/json'},
        method: "POST",
        url: "/assets/js/app-server.php",
        dataType: 'json',
        data: {
          autofunc: true,
          action: "getMovieById",
          uuid: id
        },
        async: true
      }).then(function (response) {
        $scope.responseMap = response.data[0];

        $scope.credits = JSON.parse($scope.responseMap.content);

        var options = {
          poster: $scope.tmdbConf.images_uri+($scope.responseMap.backdrop_path? $scope.responseMap.backdrop_path:$scope.responseMap.poster_path),
          responsive: true,
          html5: {
            nativeVideoTracks: true,
            hls: {
              withCredentials: true
            }
          },
          plugins: {
            httpSourceSelector: {
              default: "auto"
            },

            eventTracking: true
          }
        };

        var player = videojs('my-video', options).httpSourceSelector();

        videojs('my-video').ready(function() {
          var Interval = setInterval(() => {

            // console.log(videojs('my-video'));
            // console.log($("#my-video_html5_api")[0].duration);
            if ($("#my-video_html5_api")[0].currentTime > ($("#my-video_html5_api")[0].duration / 4)) {
              clearInterval(Interval);
              console.log("####### Video Vu");

              $scope.toMovieView(id);
            }
  
          }, (1  * 1000)) // 1 seconds
        });
      });
    }

    $scope.getUpcomingMovies = () => {
      $http({
        headers: {'Content-Type': 'application/json'},
        method: "POST",
        url: "/assets/js/app-server.php",
        dataType: 'json',
        data: {
          autofunc: true,
          action: "getUpcomingMovies",
        },
        async: true
      }).then(function (response) {
        $scope.upComingMovies = response.data.upComingMovies;

        $timeout(function(){
          $scope.initSliderByClass('.upcoming-slider');
        }, 100);
      });
    }


    $scope.toMovieView = (id) => {
      $http({
        headers: {'Content-Type': 'application/json'},
        method: "POST",
        url: "/assets/js/app-server.php",
        dataType: 'json',
        data: {
          autofunc: true,
          action: "toMovieView",
          uuid: id
        },
        async: true
      }).then(function (response) {
        console.log(response);
      })
    }

    $scope.responseMap  = false;
    $scope.upComingMovies = [];
    $scope.getMovieById(new URLSearchParams(window.location.search).get('id'));

    // scope tmdb
    $scope.tmdbConf = tmdbConf;

    $scope.initSliderByClass = (className) => {
      $('.favorites-slider').slick({
        lazyLoad: 'ondemand',
        dots: false,
        arrows: true,
        prevArrow: '<div class="slick-nav prev-arrow"><i></i><svg><use xlink:href="#circle"></svg></div>',
        nextArrow: '<div class="slick-nav next-arrow"><i></i><svg><use xlink:href="#circle"></svg></div>',
        infinite: true,
        speed: 1500,
        autoplay: true,
        autoplaySpeed: 2500,
        slidesToShow: 4,
        slidesToScroll: 1,
        responsive: [
        {
          breakpoint: 1200,
          settings: {
          slidesToShow: 3,
          slidesToScroll: 1,
          infinite: true,
          dots: true
          }
        },
        {
          breakpoint: 768,
          settings: {
          slidesToShow: 2,
          slidesToScroll: 1,
          infinite: true,
          dots: true
          }
        },
        {
          breakpoint: 480,
          settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
          infinite: true,
          dots: true
          }
        }
        ]
      });

      $('.slick-nav').on('click touch', function (e) {
        e.preventDefault();
        var arrow = $(this);
        if (!arrow.hasClass('animate')) {
          arrow.addClass('animate');
          setTimeout(() => {
            arrow.removeClass('animate');
          }, 1600);
        }
      });
    }
  }]);

  app.controller('appListMovie', ['$scope', '$http', function($scope, $http) {
    $scope.getListMovie = () => {
      $http({
        headers: {'Content-Type': 'application/json'},
        method: "POST",
        url: "/assets/js/app-server.php",
        dataType: 'json',
        data: {
          autofunc: true,
          action: "getListMovie1",
          limit: 5,
          max: 1
        },
        async: true
      }).then(function (response) {
        $scope.resultsMovie = response.data.data;
        console.log(response.data);
      });
    }

    $scope.resultsMovie = [];
  }]);

  app.controller('appSetting', ['$scope', '$http', function($scope, $http) {
    // ##############
    // Déclaration Func
    $scope.getSession = () => {
      $scope.POST({autofunc: false, action: "getSession"}, 'json', 'application/json', function (response) {
        $scope.settingMap = response.data[0];
        $scope.PreviewImage = '/assets/images/user/'+$scope.settingMap.avatar;
      })
    }

    $scope.saveLine = () => {
        $scope.btnSave        = true;
    }

    $scope.saveSetting = () => {
      $scope.POST({autofunc: false, action: "saveSession", data: [$scope.settingMap]}, 'json', 'application/json', (callback) => {
        $scope.btnSave        = false;
      })
    }

    $scope.sendPicture = () => {
      var formData = new FormData();
      var file = document.getElementById('customFile').files[0];
      formData.append('file', file);

      $scope.POST(formData, undefined, undefined, () => {
        $scope.PreviewImageSave = false;
      });
    }

    $scope.POST = (param, _dataType = undefined, _headers = undefined, callback = undefined) => {
      $http({
        headers: {'Content-Type': _headers},
        method: "POST",
        url: "/assets/js/app-server.php",
        dataType: _dataType,
        data: param,
        async: true
      }).then(function (response) {
        callback(response);
      });
    }

    $scope.SelectFile = function (e) {
      var reader = new FileReader();
      reader.onload = function (e) {
        $scope.PreviewImage = e.target.result;
        $scope.PreviewImageSave = true;
        $scope.$apply();
      };

      reader.readAsDataURL(e.target.files[0]);
    };

    // ############
    // Init
    $scope.settingMap   = false;
    $scope.edit         = false;
    $scope.editLine     = false;
    $scope.btnSave      = false;

    $scope.getSession();
  }]);

  app.controller('appAddMovie', ['$scope', '$http', function($scope, $http, $sce) {
    $scope.tmdb_search = () => {
      $scope.getMovie($scope.tmdbData.replaceAll(" ", "+"), (callback) => {
        $scope.tmdbDetailsResult = callback.data.results;
        console.log(callback.data.results);
      });
    }

    $scope.getMovie = (param, callback = undefined) => {

      var _url  = $scope.tmdbConf.base_uri+
                  "search/movie"+
                  "?query="+param+
                  "&api_key="+$scope.tmdbConf.api_key+
                  "&language="+$scope.tmdbConf.language;

      $http({
        headers: {'Content-Type': 'application/json'},
        method: "GET",
        url: _url,
        dataType: 'json',
        async: true
      }).then(function (response) {
        callback(response);
        $scope.tmdbDetailsShow = false;
      });
    }

    $scope.getInfoMovie = () => {
      console.log($scope.tmdbDataSelect);

      var _url  = $scope.tmdbConf.base_uri+
                  "movie/"+$scope.tmdbDataSelect+
                  "?api_key="+$scope.tmdbConf.api_key+
                  "&language="+$scope.tmdbConf.language;

      $http({
        headers: {'Content-Type': 'application/json'},
        method: "GET",
        url: _url,
        dataType: 'json',
        async: true
      }).then(function (response) {
        $scope.tmdbDetails["info"] = response.data;
      });

      var _url  = $scope.tmdbConf.base_uri+
                  "movie/"+$scope.tmdbDataSelect+
                  "/credits"+
                  "?api_key="+$scope.tmdbConf.api_key+
                  "&language="+$scope.tmdbConf.language;

      $http({
        headers: {'Content-Type': 'application/json'},
        method: "GET",
        url: _url,
        dataType: 'json',
        async: true
      }).then(function (response) {
        $scope.tmdbDetails["credits"] = response.data;
      });

      _url  = $scope.tmdbConf.base_uri+
              "movie/"+$scope.tmdbDataSelect+
              "/images"+
              "?api_key="+$scope.tmdbConf.api_key+
              "&language="+$scope.tmdbConf.language+
              "&include_image_language=fr,en";
      $http({
        headers: {'Content-Type': 'application/json'},
        method: "GET",
        url: _url,
        dataType: 'json',
        async: true
      }).then(function (response) {
        $scope.tmdbDetails["images"] = response.data;
      });

      _url  = $scope.tmdbConf.base_uri+
              "movie/"+$scope.tmdbDataSelect+
              "/videos"+
              "?api_key="+$scope.tmdbConf.api_key+
              "&language="+$scope.tmdbConf.language;
              "&include_image_language=fr,en";
      $http({
        headers: {'Content-Type': 'application/json'},
        method: "GET",
        url: _url,
        dataType: 'json',
        async: true
      }).then(function (response) {
        $scope.tmdbDetails["videos"] = response.data;
        $scope.tmdbDetailsShow       = true;
      });

      $http({
        headers: {'Content-Type': 'application/json'},
        method: "POST",
        url: "/assets/js/app-server.php",
        dataType: 'json',
        data: {
          autofunc: false,
          action: "getPathMovie",
        },
        async: true
      }).then(function (response) {
        $scope.tmdbDetails["path"] = response.data;
        console.log($scope.tmdbDetails);
      });
    }

    $scope.submitMovie = () => {
      $http({
        headers: {'Content-Type': 'application/json'},
        method: "POST",
        url: "/assets/js/app-server.php",
        dataType: 'json',
        data: {
          autofunc: false,
          action: "saveMovie",
          data: $scope.tmdbDetails["info"],
          credits: $scope.tmdbDetails["credits"],
          poster: $scope.posterSelected,
          backdrop: $scope.backdropSelected,
          video: $scope.videoSelect,
          qualite: $scope.qualiteSelected,
          status: $scope.statusSelected,
          language: $scope.languageSelected,
          pathfile: $scope.pathFileSelected,
        },
        async: true
      }).then(function (response) {
        console.log(response);
        
        $scope.resetMovie();
      });

      
    }

    $scope.resetMovie = () => {
      $scope.tmdbData           = "";
      $scope.tmdbDetailsResult  = false;
      $scope.tmdbDataSelect     = false;
      $scope.tmdbDetails        = [];
      $scope.tmdbDetailsShow    = false;
    }

    $scope.resetMovie();

    // scope tmdb
    $scope.tmdbConf = tmdbConf;

    // func date fr
    $scope.todatefr = (x) => {
      if (x == undefined) return "";
      moment.locale('fr');
      return moment(x).format('LL');
    }
    $scope.formatTime = (x) => {
      if (x == undefined) return "";
      const h = Math.floor(x / 3600);
      const m = Math.floor((x % 3600) / 60);
      const s = Math.round(x % 60);
      return [
        h,
        m > 9 ? m : (h ? '0' + m : m || '0'),
        s > 9 ? s : '0' + s
      ].filter(Boolean).join(':');
    }
  }]);
})(window.angular);