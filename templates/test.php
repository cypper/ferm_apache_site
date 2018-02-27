

<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	ini_set('disable_functions', '');
	error_reporting(E_ALL);
	ini_set ("extension", "mongodb.so");
	define("MG_DB", "localhost");
	define("MG_NAME", "fermua");
	define("MG_PASSWORD", urlencode("xDH&65rNrh@Yzy+s"));
	echo "asdf";
	/**
	* MONGO_DB
	*/
	class MG
	{
		function __construct() {
			$this->manager = new MongoDB\Driver\Manager(
				// 'mongodb+srv://fermua:xDH&65rNrh@Yzy+s@fermua-prj1a.mongodb.net/test'
				// 'mongodb://fermua:xDH&65rNrh@Yzy+s@fermua-shard-00-00-prj1a.mongodb.net:27017,fermua-shard-00-01-prj1a.mongodb.net:27017,fermua-shard-00-02-prj1a.mongodb.net:27017/test?ssl=true&replicaSet=fermua-shard-0&authSource=admin'
				'mongodb://'.MG_NAME.':'.MG_PASSWORD.'@fermua-shard-00-00-prj1a.mongodb.net:27017,fermua-shard-00-01-prj1a.mongodb.net:27017,fermua-shard-00-02-prj1a.mongodb.net:27017/test?ssl=true&replicaSet=fermua-shard-0&authSource=admin'
			);

			// $db = $client->test;
		}
		function get_all_vars($db,$collection) {
			$filter = [];
			$options = [];
			$query = new MongoDB\Driver\Query($filter, $options);
			$cursor = $this->manager->executeQuery($db.'.'.$collection, $query); // $mongo contains the connection object to MongoDB
			   // UT::show($rows);
			// $results = [];
			$results = $cursor->toArray();

			// foreach($cursor as $r){
			//    array_push($results, $r);
			// }
			return $results;
		}
		function create_collection($collection) {
			$db = $m->helfis;
			echo "Database mydb selected";
			$collection = $db->createCollection("myhell");
			echo "Collection created succsessfully";

			$collection = $db->dashboard;
			echo "Collection selected succsessfully";
		}
		function execute_write($bulk,$where) {
			$writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 100);
			$result = $this->manager->executeBulkWrite($where, $bulk, $writeConcern);
			
			/* If the WriteConcern could not be fulfilled */
			if ($writeConcernError = $result->getWriteConcernError()) {
			    printf("%s (%d): %s\n", $writeConcernError->getMessage(), $writeConcernError->getCode(), var_export($writeConcernError->getInfo(), true));
			    UT::show('');
			}

			/* If a write could not happen at all */
			foreach ($result->getWriteErrors() as $writeError) {
			    printf("Operation#%d: %s (%d)\n", $writeError->getIndex(), $writeError->getMessage(), $writeError->getCode());
			    UT::show('');
			}
			
		}
		function insert($db,$collection,$array) {
			$bulk = new MongoDB\Driver\BulkWrite();

			$bulk->insert($array);

			$this->execute_write($bulk,$db.'.'.$collection);

		}
		function delete($db,$collection,$filter) {
			$bulk = new MongoDB\Driver\BulkWrite();

			$bulk->delete($filter);

			$this->execute_write($bulk,$db.'.'.$collection);

		}
		function update($db,$collection,$filter,$newObj,$opt=[]) {
			$bulk = new MongoDB\Driver\BulkWrite();

			$bulk->update($filter,$newObj,$opt);

			$this->execute_write($bulk,$db.'.'.$collection);

		}
		// function collection_from_json() {
		// 	$bson = MongoDB\BSON\fromJSON($json);
		// 	$value = MongoDB\BSON\toPHP($bson);
		// 	UT::show($value);
		// }
	}

	// $MG->insert(MG_DB,"customers",["fuck1"=>"yo1u"]);
	// $MG->update(MG_DB,"customers",[],["xs"=>"qs"],['multi'=>false]);
	// $MG->delete(MG_DB,"customers",[]);
	$MG = new MG();
	echo "<pre>";
	var_dump($MG->get_all_vars(MG_DB,"capital"));
	echo "</pre>";

?>