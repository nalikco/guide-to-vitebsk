import {
    FakeTelegramService,
    TelegramService,
    TelegramServiceInterface,
} from "./telegram-service.ts";
import { configuration } from "../config";

console.log(configuration.APP_ENV);

const telegramService: TelegramServiceInterface =
    configuration.APP_ENV !== "local"
        ? new TelegramService()
        : new FakeTelegramService();

export { telegramService };
