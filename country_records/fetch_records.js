const https = require('http');

https.get(`http://overpass-api.de/api/interpreter?data=[out:json];node["place"~"city|town|village"]["is_in:country_code"="${process.argv[2]}"];out;`, (resp) => {
  let data = '';

  // A chunk of data has been recieved.
  resp.on('data', (chunk) => {
    data += chunk;
  });

  // The whole response has been received. Print out the result.
  resp.on('end', () => {
    console.log(JSON.parse(data));
  });

}).on("error", (err) => {
  console.log("Error: " + err.message);
});