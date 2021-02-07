console.log('APP');

const getData = async () => {
  return await fetch('server.php', {
    method: 'GET',
    body: null,
    headers: { 'Content-Type': 'application/json' },
  })
    .then((response) => {
      return response.json();
    })
    .catch((err) => {
      console.log(err);
    });
};

getData().then((res) => console.log(res));
