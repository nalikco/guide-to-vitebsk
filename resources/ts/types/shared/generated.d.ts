declare namespace App.DTO.Place {
export type PlaceCategoryData = {
parent: App.DTO.Place.PlaceCategoryData | null;
name: string;
imageUrl: string;
};
export type UserData = {
telegramId: number;
firstName: string;
lastName: string;
username: string;
languageCode: string;
allowsWriteToPm: boolean;
};
}
