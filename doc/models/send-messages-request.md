
# Send Messages Request

## Structure

`SendMessagesRequest`

## Fields

| Name | Type | Tags | Description | Getter | Setter |
|  --- | --- | --- | --- | --- | --- |
| `messages` | [`Message[]`](../../doc/models/message.md) | Required | - | getMessages(): array | setMessages(array messages): void |

## Example (as JSON)

```json
{
  "messages": {
    "content": "Hello world!",
    "destination_number": "+61491570156"
  }
}
```

