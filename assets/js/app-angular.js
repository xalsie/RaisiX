(function(angular) {
    'use strict';
    var app = angular.module('appRoot', []);

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

        $scope.getAvatar();
    }]);
  
    app.controller('appSetting', ['$scope', '$http', function($scope, $http) {
        // ##############
        // Déclaration Func
        $scope.getSession = () => {
          $scope.POST({autofunc: false, action: "getSession"}, 'json', 'application/json', function (response) {
            $scope.settingMap = response.data[0];
          })
        }

        $scope.saveLine = () => {
            $scope.btnSave        = true;
        }
  
        $scope.saveSetting = () => {
            // $http({


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

        $scope.SelectFile = function (e) {85
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
})(window.angular);