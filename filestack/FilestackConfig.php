<?php
namespace Filestack;

/**
 * Filestack config constants, such as base URLs
 */
class FilestackConfig
{
    const API_URL = 'https://www.filestackapi.com/api';
    const PROCESS_URL = 'https://process.filestackapi.com';
    const CDN_URL = 'https://cdn.filestackcontent.com';
    const UPLOAD_URL = 'https://upload.filestackapi.com';

    const UPLOAD_CHUNK_SIZE = 1024 * 1024 * 25; // last_digit=MB
    const UPLOAD_CONCURRENT_JOBS = 30;
}
