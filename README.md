> [!NOTE]
> 注意：これは過去の学習記録です。
> 本リポジトリは、私が学習初期（小学生〜中学生）に作成した成果物を、成長の記録として保存・公開しているアーカイブです。
> 当時の環境や理解の範囲で書かれており、現在の私の設計方針・開発プロセス・品質基準を示すものではありません。
> このリポジトリは「当時の状態そのもの」を残すことに意味があるため、修正・改修・削除は行いません。
> 本リポジトリ単体のコードベースから定量的・網羅的な評価を行うことは推奨しません。
> 必要な場合は、GitHubプロフィールの pinned リポジトリ、直近のコミット履歴、OSS貢献など、複数リポジトリを横断して総合的に参照してください。

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

# License

TwitterAPIClient is under MIT License
