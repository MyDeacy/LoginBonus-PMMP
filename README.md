# LoginBonus-PMMP
This is a plugin that implements a login bonus on the PocketMine-MP server.  
  
PocketMine-MPサーバーにログインボーナスを加えます。  
EconomyAPI対応。
  

```yaml
#ログインボーナスで付与する金額
bonus: 1000

#連続ログインの倍数で金額変更可能 (例：連続ログイン回数が3の倍数だったら...)
period-count: 3
period-bonus: +500
period-message: §a[i] > 連続ログイン{%1}回！

#ログインボーナス付与
send-bonus-message: §b[i] > ログインボーナス {%1} を配布しました！
form-title: ログインボーナス
```