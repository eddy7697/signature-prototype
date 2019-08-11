export function handler(code) {
    let exceotionMap = [
        {
            code: 1001,
            label: '帳號或密碼錯誤，請重新輸入！'
        },
        {
            code: 1002,
            label: '使用者權杖過期，請重新登入。'
        }
    ]

    return _.find(exceotionMap, ['code', code]).label
}