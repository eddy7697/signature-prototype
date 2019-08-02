export function handler(code) {
    let exceotionMap = [
        {
            code: 1001,
            label: '帳號或密碼錯誤，請重新輸入！'
        }
    ]

    return _.find(exceotionMap, ['code', code]).label
}