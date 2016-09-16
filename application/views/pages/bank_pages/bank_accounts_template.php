
<div ng-app ="bank_accountsTempApp" class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <div ng-controller ="Bank_accountTempCtrl as bank_accountCtrl">    
        
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
                    <th></th>
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
                <td><?php echo form_open("bank_book",array('role'=>'form','class'=>'form-custom')); ?>
                    <input type="hidden" name="account_id" value="{{ bank_account.account_id }}" />
                    <button type="submit" class="btn btn-primary">Add Transaction</button>
                    <?php echo form_close(); ?>
                </td>
            </tr>            
        </table>
        
        <script  src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.11/angular.js"></script>
        <script>
          angular.module('bank_accountsTempApp', [])
            .controller('Bank_accountTempCtrl', ['$http', function($http) {
              var self = this;
              self.bank_accounts = [];
              self.banks = [];
              self.partys = [];
              self.bank_account_groups = [];
              self.newBank_account = {};
              var fetchbank_accounts = function() {
                return $http.get('get_bank_accounts').then(
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
