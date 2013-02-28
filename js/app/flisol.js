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
    templateUrl: 'partials/aboutFlisol.html',
    controller: AboutFlisolCrtl
  });

  $routeProvider.when('/sobre/FLISOL', {
    templateUrl: 'partials/aboutFlisol.html',
    controller: AboutFlisolCrtl
  });

  $routeProvider.when('/sobre/campinas', {
    templateUrl: 'partials/where.html',
    controller: WhereCrtl
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

function main($scope, $route, $routeParams, $location, $rootScope) {
  $scope.$route = $route;
  $scope.$location = $location;
  $scope.$routeParams = $routeParams;
  $rootScope.pageTitle = "Home";

  jQuery('#slider').flexslider();
}

function AboutCrtl($scope, $routeParams, $rootScope) {

  $rootScope.pageTitle = "Inscreva-se";

  $scope.user = {};
  $scope.user.name = "Nome";
  $scope.user.lastname = "Sobrenome";
  $scope.user.rg = "RG";
  $scope.user.email = "Email";
  $scope.user.site = "Website";
  $scope.user.city = "Cidade";
  $scope.user.state = "Estado";
}

function SingUpCtrl($scope,$http){
  $scope.sendData = function(){

    var user = $scope.user;
    var user_data = {
      "nome":user.name,
      "sobrenome":user.lastname,
      "rg":user.rg,
      "email":user.email,
      "website":user.site == 'Website' ? '' : user.site,
      "cidade":user.city,
      "estado":user.state
    }

    $.ajax({
          url: 'http://www.campinasrock.com/flisol/users',
          type: 'GET',
          data : user_data,
          dataType: 'jsonp',
          jsonp:false,
          callback: '',
          //contentType : 'application/json; charset=utf-8',
          success:function(){
            $('#contact_form').css('display','none');
            $('.post > h4').html('Inscrição realizada com sucesso.');
            window.scrollTo(0,0);

          },
          error: function(xhr, textStatus, errorThrown) {
            if(xhr.status==200){
                $('#contact_form').css('display','none');
                $('.post > h4').html('Inscrição realizada com sucesso.');
                window.scrollTo(0,0);              
            }else{
                $('.post > h4').html('Ocorreu um erro, por favor tente mais tarde.');
                window.scrollTo(0,0);
            }
          }
      });

   
    return false;
   }
}

function ContactCrtl($scope, $routeParams, $rootScope) {

}

function PresentationsCrtl($scope, $routeParams, $rootScope) {

}

function SpeechersCrtl($scope, $routeParams, $rootScope) {

}

function WhereCrtl($scope, $routeParams, $rootScope) {
  $scope.areaTitle = "Flisol Campinas 2013";
  $scope.breadCrumb = ["Sobre o Flisol", "Campinas 2013"];
  $rootScope.pageTitle = "Onde e Como?";

}

function AboutFlisolCrtl($scope, $routeParams, $rootScope) {
  $scope.areaTitle = "Flisol 2013";
  $scope.breadCrumb = ["Sobre o Flisol", "Na América Latina"];
  $rootScope.pageTitle = "LATAM";

}