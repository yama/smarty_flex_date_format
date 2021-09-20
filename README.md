# smarty_flex_date_format

```
{日付文字列またはUNIXタイムスタンプ|flex_date_format:'%年%m月%d日(%曜)'}
```

```
{日付文字列またはUNIXタイムスタンプ|flex_date_format:'Y年m月d日 H:i'}
```

- strftime()形式・date()形式どちらでも指定可。strftime()形式の場合は `%曜` が使える。
- 入力値は日付文字列・UNIXタイムスタンプどちらも可。`+3 days` なども可。
- 値がゼロだった時は1970-01-01とかではなくnullを出力(つまり何も出力しない)
