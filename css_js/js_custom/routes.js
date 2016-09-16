// File: chapter10/routing-example/app/scripts/app.js
angular.module('bank_accountsApp', ['ngRoute'])
  .config(function($routeProvider) {
    $routeProvider.when('/', {
      templateUrl: '<h1>Gokul</h1>',//'index.php/bank_account/get_bank_accounts_template',
      controller: 'Bank_accountCtrl'
    });
    $routeProvider.otherwise({
      redirectTo: '/'
    });
  });
