declare namespace App.DTO.Place {
export type PlaceCategoryData = {
parent: App.DTO.Place.PlaceCategoryData | null;
name: string;
imageUrl: string;
};
}
declare namespace App.DTO.User {
export type UserData = {
id: number;
telegramId: number;
firstName: string;
lastName: string;
username: string;
languageCode: string;
allowsWriteToPm: boolean;
createdAt: string;
};
}
