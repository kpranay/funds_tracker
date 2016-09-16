<div ng-app ="instrumentsApp" class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <div ng-controller ="InstrumentCtrl as instrumentCtrl">
    <form class="form-inline" ng-submit="instrumentCtrl.add()" name="addInstrument">            
        <div class="form-group">
          <label for="exampleInputName2">Instrument Name</label>
          <input type="text" class="form-control" ng-model="instrumentCtrl.newInstrument.instrument_type" required/>              
        </div>        
        <input type="submit" class="btn btn-default" value="Add" ng-disabled="addInstrument.$invalid">
    </form>    

    <h3>instruments Added</h3>

    <table class="table table-bordered table-hover">
        <thead>
            <tr>                    
                <th>Instrument Name</th>                
            </tr>
        </thead>
        <tr class="success" ng-repeat="instrument in instrumentCtrl.instruments">
            <td ng-bind="instrument.instrument_type"></td>            
        </tr>
        <tr class="active">
            <td>{{ instrumentCtrl.newInstrument.instrument_type }}</td>           
        </tr>
    </table>

    <script  src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.11/angular.js"></script>
    <script>
      angular.module('instrumentsApp', [])
        .controller('InstrumentCtrl', ['$http', function($http) {
          var self = this;
          self.instruments = [];          
          self.newInstrument = {};
          var fetch_instruments = function() {
            return $http.get('index.php/instrument_type/get_instrument_type').then(
                function(response) {
              self.instruments = response.data;                  
            }, function(errResponse) {
              console.error(errResponse.data.msg);
            });
          };
          
          fetch_instruments();
          
          self.add = function() {
            $http.post('index.php/instrument_type/add_instrument_type', self.newInstrument)
                .then(fetch_instruments)
                .then(function(response) {
                  self.newInstrument = {};
                });
          };

        }]);
    </script>
</div>
</div>
