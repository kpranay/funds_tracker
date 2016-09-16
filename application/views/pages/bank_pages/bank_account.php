
<div ng-app ="bank_accountsApp" class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <div ng-controller ="Bank_accountCtrl as bank_accountCtrl">
        <form class="form-inline" ng-submit="bank_accountCtrl.add()" name="addBank_account">            
            <div class="form-group">
              <label for="exampleInputName2">Bank_account Name</label>
              <input type="text" class="form-control" ng-model="bank_accountCtrl.newBank_account.account_name" required/>              
            </div>
            <div class="form-group">
              <label for="exampleInputName2">Bank Account ID</label>
              <input type="text" class="form-control" ng-model="bank_accountCtrl.newBank_account.account_id"/>              
            </div>
            <div class="form-group">
              <label for="exampleInputEmail2">Bank ID</label>
              <select class="form-control" ng-model="bank_accountCtrl.newBank_account.bank_id" 
                  ng-options="bank.bank_id as bank.bank_name for bank in bank_accountCtrl.banks">                          
              </select>
            </div>            
            <div class="form-group">
              <label for="exampleInputName2">Account Number</label>
              <input type="text" class="form-control" ng-model="bank_accountCtrl.newBank_account.account_number"/>              
            </div>
            <div class="form-group">
              <label for="exampleInputName2">Bank Branch</label>
              <input type="text" class="form-control" ng-model="bank_accountCtrl.newBank_account.branch"/>              
            </div>
            <div class="form-group">
              <label for="exampleInputName2">Branch Location</label>
              <input type="text" class="form-control" ng-model="bank_accountCtrl.newBank_account.location"/>              
            </div>
            <div class="form-group">
              <label for="exampleInputName2">Branch IFSC Code</label>
              <input type="text" class="form-control" ng-model="bank_accountCtrl.newBank_account.ifsc_code"/>              
            </div>
            <div class="form-group">
              <label for="exampleInputName2">MICR Code</label>
              <input type="text" class="form-control" ng-model="bank_accountCtrl.newBank_account.micr_code"/>              
            </div>
            <div class="form-group">
              <label for="exampleInputName2">SWIFT Code</label>
              <input type="text" class="form-control" ng-model="bank_accountCtrl.newBank_account.swift_code"/>              
            </div>
            <div class="form-group">
              <label for="exampleInputEmail2">Party</label>
              <select class="form-control" ng-model="bank_accountCtrl.newBank_account.party_id" 
                  ng-options="party.party_id as party.party_name for party in bank_accountCtrl.partys">                          
              </select>
            </div>           
        <!--    <div class="form-group">
              <label for="exampleInputEmail2">Select Bank_account Group</label>
              <select class="form-control" ng-model="bank_accountCtrl.newBank_account.bank_account_group_id" 
                  ng-options="group.bank_account_group_id as group.bank_account_group_name for group in bank_accountCtrl.bank_account_groups">                          
              </select>
            </div> -->
            <input type="submit" class="btn btn-default" value="Add" ng-disabled="addBank_account.$invalid">
        </form>    
        
        <h3>Bank_accounts Added</h3>
        
        <table class="table table-bordered table-hover">
            <thead>
                <tr>                    
                    <th>Bank_account Name</th>
                    <th>Bank_account ID</th>
                    <th>Bank ID</th>
                    <th>Account Number</th>
                    <th>Bank Branch</th>
                    <th>Branch Location</th>
                    <th>Branch IFSC Code</th>
                    <th>MICR Code</th>
                    <th>SWIFT Code</th>
                    <th>Party</th>
                </tr>
            </thead>
            <tr class="success" ng-repeat="bank_account in bank_accountCtrl.bank_accounts">
                <td ng-bind="bank_account.account_name"></td>
                <td ng-bind="bank_account.account_id"></td>
                <td ng-bind="bank_account.bank_id"></td>
                <td ng-bind="bank_account.account_number"></td>
                <td ng-bind="bank_account.branch"></td>
                <td ng-bind="bank_account.location"></td>
                <td ng-bind="bank_account.ifsc_code"></td>
                <td ng-bind="bank_account.micr_code"></td>
                <td ng-bind="bank_account.swift_code"></td>
                <td ng-bind="bank_account.party_id"></td>          
            </tr>
            <tr class="active">
                <td>{{ bank_accountCtrl.newBank_account.account_name }}</td>
                <td>{{ bank_accountCtrl.newBank_account.account_id }}</td>
                <td>{{ bank_accountCtrl.newBank_account.bank_id }}</td>
                <td>{{ bank_accountCtrl.newBank_account.account_number }}</td>
                <td>{{ bank_accountCtrl.newBank_account.branch }}</td>
                <td>{{ bank_accountCtrl.newBank_account.location }}</td>
                <td>{{ bank_accountCtrl.newBank_account.ifsc_code }}</td>
                <td>{{ bank_accountCtrl.newBank_account.micr_code }}</td>
                <td>{{ bank_accountCtrl.newBank_account.swift_code }}</td>
                <td>{{ bank_accountCtrl.newBank_account.party_id }}</td>     
            </tr>
        </table>
        
        <script  src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.11/angular.js"></script>
        <script>
          angular.module('bank_accountsApp', [])
            .controller('Bank_accountCtrl', ['$http', function($http) {
              var self = this;
              self.bank_accounts = [];
              self.banks = [];
              self.partys = [];
              self.bank_account_groups = [];
              self.newBank_account = {};
              var fetchbank_accounts = function() {
                return $http.get('index.php/bank_account/get_bank_accounts').then(
                    function(response) {
                  self.bank_accounts = response.data;                  
                }, function(errResponse) {
                  console.error(errResponse.data.msg);
                });
              };
              var fetch_banks = function() {
                return $http.get('index.php/bank/get_banks').then(
                    function(response) {
                  self.banks = response.data;                  
                }, function(errResponse) {
                  console.error(errResponse.data.msg);
                });
              };
              var fetch_partys = function() {
                return $http.get('index.php/party/get_party').then(
                    function(response) {
                  self.partys = response.data;                  
                }, function(errResponse) {
                  console.error(errResponse.data.msg);
                });
              };
              
              fetch_banks();
              fetch_partys();
              fetchbank_accounts();
              
              self.add = function() {
                $http.post('index.php/bank_account/add_bank_account', self.newBank_account)
                    .then(fetchbank_accounts)
                    .then(function(response) {
                      self.newBank_account = {};
                    });
              };
              
            }]);
        </script>
    </div>
    </div>
