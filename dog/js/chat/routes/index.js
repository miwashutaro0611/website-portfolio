var moment = require('moment');
var connection = require('../mysql'); // 追加

/* GET home page. */
router.get('/', function(req, res, next) {
  res.render('index', { title: 'Express' });
});

router.post('/', function(req, res, next) {
  var title = req.body.title;
  var createdAt = moment().format('YYYY-MM-DD HH:mm:ss');
  //var query = 'INSERT INTO chat (roomid,userid,chattext,datetime) VALUES ("' + title + '", ' + '"' + createdAt + '")';
  var query = 'INSERT INTO chat (roomid,datetime) VALUES ("' + title + '", ' + '"' + createdAt + '")';
  connection.query(query, function(err, rows) {
    res.redirect('/');
  });
});

module.exports = router;
