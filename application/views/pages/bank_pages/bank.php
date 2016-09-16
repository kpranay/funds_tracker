<?php ?>

<div ng-app ="banksApp" class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <div ng-controller ="BankCtrl as bankCtrl">
        <form class="form-inline" ng-submit="bankCtrl.add()" name="addBank">            
            <div class="form-group">
              <label for="exampleInputName2">Bank Name</label>
              <input type="text" class="form-control" ng-model="bankCtrl.newBank.bank_name" required/>              
            </div>
            <!--
            <div class="form-group">
              <label for="exampleInputEmail2">Select Bank Group</label>
              <select class="form-control" ng-model="bankCtrl.newBank.bank_group_id" 
                  ng-options="group.bank_group_id as group.bank_group_name for group in bankCtrl.bank_groups">                          
              </select>
            </div> -->
            <div class="form-group">
                <label for="note">Note</label>
                <input type="text" class="form-control" ng-model="bankCtrl.newBank.note" />
            </div>
            <input type="submit" class="btn btn-default" value="Add" ng-disabled="addBank.$invalid">
        </form>    
        
        <h3>Banks Added</h3>
        
        <table class="table table-bordered table-hover">
            <thead>
                <tr>                    
                    <th>Bank Name</th>
                    <th>Note</th> 
                </tr>
            </thead>
            <tr class="success" ng-repeat="bank in bankCtrl.banks">
                <td ng-bind="bank.bank_name"></td>
                <td ng-bind="bank.note"></td> 
            </tr>
            <tr class="active">
                <td>{{ bankCtrl.newBank.bank_name }}</td>
                <td>{{ bankCtrl.newBank.note }}</td>
            </tr>
        </table>
        
        <script  src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.11/angular.js"></script>
        <script>
          angular.module('banksApp', [])
            .controller('BankCtrl', ['$http', function($http) {
              var self = this;
              self.banks = [];
         //     self.bank_groups = [];
              self.newBank = {};
              self.not = {};
              var fetchbanks = function() {
                return $http.get('index.php/bank/get_banks').then(
                    function(response) {
                  self.banks = response.data;                  
                }, function(errResponse) {
                  console.error(errResponse.data.msg);
                });
              };
              /*
              var fetchgroups = function(){
                return $http.get('index.php/bank/get_bank_groups').then(
                    function(response){
                        self.bank_groups = response.data;
                    },function(errResponse){
                        console.error(errResponse.data.msg);
                    }
              )};
              fetchgroups(); */
              fetchbanks();
              
              self.add = function() {
                $http.post('index.php/bank/add_bank', self.newBank)
                    .then(fetchbanks)
                    .then(function(response) {
                      self.newBank = {};
                    });
              };
              
            }]);
        </script>
    </div>
    </div>