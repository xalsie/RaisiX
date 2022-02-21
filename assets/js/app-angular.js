(function(angular) {
  'use strict';
  var app = angular.module('appRoot', []);

  // config tmdb
  var tmdbConf = {
    api_key: "9a669d07e76293279b1bfa0e023610ed",
    base_uri: "https://api.themoviedb.org/3/",
    images_uri: "http://image.tmdb.org/t/p/w500/",
    language: "fr-FR",
    timeout: 5000
  };

  app.filter('iframeVideoYtb', ['$sce', function ($sce) {
    return function (val) {
        return $sce.trustAsResourceUrl("https://www.youtube-nocookie.com/embed/"+val);
    };
  }]);

  app.controller('appHeader', ['$scope', '$http', function($scope, $http) {
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
        console.log($scope.avatar);
      });
    }

    $scope.getNotification = () => {
      $http({
        headers: {'Content-Type': 'application/json'},
        method: "POST",
        url: "/assets/js/app-server.php",
        dataType: 'json',
        data: {
          autofunc: true,
          action: "getNotification",
        },
        async: true
      }).then(function (response) {
        $scope.notifMap = response.data;
        console.log($scope.notifMap);
        console.log($scope.notifMap._count);
      });
    }

    $scope.fromNow = (x) => {
      return moment(x, "YYYY-MM-DD hh:mm:ss").fromNow();
    }

    $scope.notifMap = false;
    $scope.getAvatar();
    $scope.getNotification();

    // scope tmdb
    $scope.tmdbConf = tmdbConf;
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
          data: $scope.tmdbDetails,
        },
        async: true
      }).then(function (response) {
        console.log(response);
      });

      $scope.tmdbDetails        = [];
    }

    $scope.resetMovie = () => {
      $scope.tmdbData           = "";
      $scope.tmdbDetailsResult  = false;
      $scope.tmdbDataSelect     = false;
      $scope.tmdbDetails        = [];
      $scope.tmdbDetailsShow    = false;
    }

    $scope.tmdbData           = "";
    $scope.tmdbDetailsResult  = false;
    $scope.tmdbDataSelect     = false;
    $scope.tmdbDetails        = [];
    $scope.tmdbDetailsShow    = false;

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