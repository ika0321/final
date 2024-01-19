new Vue({
    el:'#app',
    data() {
      return {
        activeTab: 1, // アクティブなタブ
      }
    },
    computed: {
      // 書籍登録タブがアクティブ
      acitiveRegistration() {
        return this.activeTab===1
      },
      // 更新タブがアクティブ
      acitiveUpdate() {
        return this.activeTab===2
      },
      // 削除タブがアクティブ
      acitiveDelete() {
        return this.activeTab===3
      },
      // カテゴリ登録タブがアクティブ
      acitiveCategory() {
        return this.activeTab===4
      },
    },
    methods: {
      // タブを切り替えて検索条件を初期化する
      changeTab (number) {
        this.initialize()
        this.activeTab = number
      },
    }
  });