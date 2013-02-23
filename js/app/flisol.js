angular.module('FlisolAPP', [], function($routeProvider, $locationProvider) {

  $routeProvider.when('/', {
    templateUrl: 'partials/home.html',
    controller: main
  });

  $routeProvider.when('/home/', {
    templateUrl: 'partials/home.html',
    controller: main
  });

  $routeProvider.when('/sobre/', {
    templateUrl: 'partials/users.html',
    controller: AboutCrtl
  });

  $routeProvider.when('/sobre/FLISOL', {
    templateUrl: 'partials/users.html',
    controller: AboutCrtl
  });

  $routeProvider.when('/sobre/FLISOLCAMPINAS', {
    templateUrl: 'partials/home.html',
    controller: AboutCrtl
  });

  $routeProvider.when('/inscreva-se/', {
    templateUrl: 'partials/users.html',
    controller: AboutCrtl
  });

  $routeProvider.when('/comunidade/', {
    templateUrl: 'partials/users.html',
    controller: AboutCrtl
  });

  $routeProvider.when('/palestras/', {
    templateUrl: 'partials/users.html',
    controller: PresentationsCrtl
  });

  $routeProvider.when('/palestrantes/:id', {
    templateUrl: 'partials/users.html',
    controller: SpeechersCrtl
  });

  $routeProvider.when('/contato/', {
    templateUrl: 'partials/contact.html',
    controller: ContactCrtl
  });

  $locationProvider.hashPrefix('!');

});

// Controllers

function main($scope, $route, $routeParams, $location) {
  $scope.$route = $route;
  $scope.$location = $location;
  $scope.$routeParams = $routeParams;
}

function AboutCrtl($scope, $routeParams) {

}

function ContactCrtl($scope, $routeParams) {

}

function PresentationsCrtl($scope, $routeParams) {

}

function SpeechersCrtl($scope, $routeParams) {

}