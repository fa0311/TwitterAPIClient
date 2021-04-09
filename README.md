# TwitterAPIClient

TwitterAPI を利用してツイートを閲覧することが出来ます<br>
sample:[github.io](https://fa0311.github.io/TwitterAPIClient/sample/sample.html "github.io")

## Installation

config.json に APIkey を入力してください<br>
user_timeline の解説:[twitter.com](https://developer.twitter.com/en/docs/twitter-api/v1/tweets/timelines/api-reference/get-statuses-user_timeline "twitter.com")

## How to use

index.php にアクセスすると表示されます<br>

### Option

| method | key  | description                                                               |
| ------ | ---- | ------------------------------------------------------------------------- |
| get    | type | json と指定すると json 形式て結果が得られます。                           |
| get    | id   | config で user_timeline を複数指定した際に使います。デフォルトは 0 です。 |
