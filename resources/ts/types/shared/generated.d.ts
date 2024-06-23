declare namespace App.DTO.Telegram {
export type TelegramUserData = {
id: number;
telegramId: number;
firstName: string;
lastName: string;
username: string;
languageCode: string;
allowsWriteToPm: boolean;
};
}
declare namespace App.DTO.User {
export type UserData = {
id: number;
username: string;
telegramUser: any;
createdAt: string;
updatedAt: string;
};
}
