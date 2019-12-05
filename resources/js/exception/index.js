export function handler(code) {
    let label = ''

    // internal error
    if (code == 500) label = '系統內部錯誤，請聯繫管理員。'
    if (code == 503) label = '基礎設施出錯誤，請聯繫系統管理員。'

    // Auth methods
    if (code == 401) label = '使用者登入權杖無效，請重新登入。'
    if (code == 403) label = '使用者權杖過期，請重新登入。'
    if (code == 419) label = '使用者帳號或密碼錯誤。'
    if (code == 461) label = '舊密碼輸入錯誤。'
    if (code == 462) label = '新密碼輸入不一致。'
    if (code == 1001) label = '帳號或密碼錯誤，請重新輸入！'
    if (code == 1002) label = '使用者權杖過期，請重新登入。'

    // Admin user methods
    if (code == 440) label = '使用者無法刪除自己的帳號，請求駁回。'

    return label
}