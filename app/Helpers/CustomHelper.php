<?php

use App\Models\Order;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Intervention\Image\Facades\Image;

if (!function_exists('customUpload')) {

    /**
     * The function `customUpload` uploads a file to a specified path and resizes it if it is an image.
     * 
     * @param UploadedFile mainFile The main file that is being uploaded. It is an instance of the
     * UploadedFile class.
     * @param string uploadPath The path where the uploaded file will be stored.
     * @param reqWidth The required width of the uploaded image. If this parameter is not provided or is
     * set to null, the image will not be resized.
     * @param reqHeight The "reqHeight" parameter is an optional integer value that specifies the required
     * height of the uploaded image. If this parameter is provided, the uploaded image will be resized to
     * the specified height while maintaining its aspect ratio. If this parameter is not provided, the
     * uploaded file will not be resized.
     * 
     * @return array an array containing information about the uploaded file, such as the file name, file
     * extension, and file size. The array is also being sanitized using the `array_map` function with the
     * `htmlspecialchars` function as the callback.
     */

    function customUpload(UploadedFile $mainFile, string $uploadPath, ?int $reqWidth = null, ?int $reqHeight = null): array
    {
        $originalName = pathinfo($mainFile->getClientOriginalName(), PATHINFO_FILENAME);

        $hashedName = substr($mainFile->hashName(), -12);

        $fileName = $originalName . '_' . $hashedName;

        if (!is_dir($uploadPath)) {
            if (!mkdir($uploadPath, 0777, true)) {
                abort(404, "Failed to create the directory: $uploadPath");
            }
        }

        if (strpos($mainFile->getMimeType(), 'image') === 0) {
            $requestImgPath = "{$uploadPath}/requestImg";
            if (!is_dir($requestImgPath)) {
                if (!mkdir($requestImgPath, 0777, true)) {
                    abort(404, "Failed to create the directory: $requestImgPath");
                }
            }

            $img = Image::make($mainFile);
            $img->save("$uploadPath/$fileName");
            if ($reqWidth !== null && $reqHeight !== null) {
                $img->resize($reqWidth, $reqHeight, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
                $img->save("$requestImgPath/$fileName");
            }
        } else {
            $mainFile->storeAs('public/files/', $fileName);
        }

        $output = [
            'status'         => 1,
            'file_name'      => $fileName,
            'file_extension' => $mainFile->getClientOriginalExtension(),
            'file_size'      => $mainFile->getSize(),
            'file_type'      => $mainFile->getMimeType(),
        ];

        return array_map('htmlspecialchars', $output);
    }
}
if (!function_exists('generateTransactionId')) {
    /**
     * Generate a unique Transaction ID with current date and time.
     *
     * @return string
     */
    function generateTransactionId()
    {
        try {
            $attempt = 0;
            do {
                $currentDateTime = now()->format('YmdHis');
                $transactionId = 'TXN' . $currentDateTime . Str::uuid();
                if ($attempt > 0) {
                    $transactionId .= $attempt;
                }
                $attempt++;

                // Check if the transaction ID is unique
                $isUniqueId = !Order::where('transaction_id', $transactionId)->exists();
            } while (!$isUniqueId && $attempt <= 10);

            // Handle case where unique ID is not generated after 10 attempts
            if (!$isUniqueId) {
                Log::error('Unable to generate unique Transaction ID after 10 attempts');
                return null;
            }

            return $transactionId;
        } catch (Exception $e) {
            Log::error('Error generating Transaction ID: ' . $e->getMessage());
            // Use a more unique fallback ID
            return 'TXN' . Str::uuid();
        }
    }
}

if (!function_exists('generateOrderNumber')) {
    /**
     * Generate a unique Order Number.
     *
     * @return string
     */
    function generateOrderNumber()
    {
        $attempt = 0;
        do {
            $currentDateTime = now()->format('YmdHis');
            $orderNumber = 'ORD' . $currentDateTime . Str::uuid();
            if ($attempt > 0) {
                $orderNumber .= $attempt;
            }
            $attempt++;

            // Check if the order number is unique
            $isUniqueNumber = !Order::where('order_number', $orderNumber)->exists();
        } while (!$isUniqueNumber && $attempt <= 10);

        if (!$isUniqueNumber) {
            Log::error('Unable to generate unique Order Number after 10 attempts');
            return null;
        }

        return $orderNumber;
    }
}

if (!function_exists('generateInvoiceNumber')) {
    /**
     * Generate a unique Invoice Number.
     *
     * @return string
     */
    function generateInvoiceNumber()
    {
        $attempt = 0;
        do {
            $currentDateTime = now()->format('YmdHis');
            $invoiceNumber = 'INV' . $currentDateTime . Str::uuid();
            if ($attempt > 0) {
                $invoiceNumber .= $attempt;
            }
            $attempt++;

            // Check if the invoice number is unique
            $isUniqueNumber = !Order::where('invoice_number', $invoiceNumber)->exists();
        } while (!$isUniqueNumber && $attempt <= 10);

        if (!$isUniqueNumber) {
            Log::error('Unable to generate unique Invoice Number after 10 attempts');
            return null;
        }

        return $invoiceNumber;
    }
}
